<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Book::factory(33)->create()->each(function ($book)
        {
        $numReviews=random_int(5,30);
        Review::factory()
        ->count($numReviews)
        ->for($book)
        ->good()
        ->create();
        });
 
        Book::factory(33)->create()->each(function ($book)
        {
        $numReviews=random_int(5,30);
        Review::factory()
        ->count($numReviews)
        ->for($book)
        ->average()
        ->create();
        });


        Book::factory(33)->create()->each(function ($book)
        {
        $numReviews=random_int(5,30);
        Review::factory()
        ->count($numReviews)
        ->for($book)
        ->bad()
        ->create();
        });

        }
}
