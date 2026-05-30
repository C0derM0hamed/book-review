<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

      public function scopeTitle(Builder $query,string $title):Builder
    {
     return $query->where('title','like','%'.$title.'%');
    }

    public function scopePopular(Builder $query, $from=null , $to=null):Builder
    {
        return $query->withCount([
            'reviews'=>fn(Builder $q)=>$this->dateRangeFilter($q,$from,$to)
        ])->orderBy('reviews_count','desc');    
        }

    public function scopeHighestRated(Builder $query, $from=null , $to=null):Builder
    {
        return $query->withAvg([
            'reviews'=>fn(Builder $q)=>$this->dateRangeFilter($q,$from,$to)
            ],'rating')
        ->orderBy('reviews_avg_rating','desc');
    }

    public function scopeMinReviews(Builder $query,int $min):Builder
    {
        return $query->has('reviews_count','>=',$min); 
    }

    private function dateRangeFilter(Builder $query, $from=null , $to=null)
    {
         if($from && !$to)
                {
                    $query->where('created_at','>=',$from);
                }
                elseif($to && !$from)
                {
                    $query->where('created_at','<=',$to);
                }
                elseif($from && $to)
                {
                    $query->whereBetween('created_at',[$from,$to]);
                }
    }

}
