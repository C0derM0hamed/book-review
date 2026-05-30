<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title =(string)$request->input('title');
        $filter = $request->input('filter');

        $books = Book::when(
            $title !== '',
            fn($query) => $query->title($title)
        );
         //compact('books')

            $books = match ($filter) {
                'popular_last_month' => $books->popular(now()->subMonth(), now()),
                'popular_last_6_months' => $books->popular(now()->subMonths(6), now()),
                'highest_rated_last_month' => $books->highestRated(now()->subMonth(), now()),
                'highest_rated_last_6_months' => $books->highestRated(now()->subMonths(6), now()),
                default => $books->latest(),
            };
         $books = $books->get();
         
        return view('books.index', ['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
