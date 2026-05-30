@extends('layouts.app')
@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>

    <form method="GET" action="{{ route('books.index') }}" class="flex items-center  mb-6 space-x-2">
      <input value="{{ request('title') }}" type="text" name="title"  class="input">
      <input type="hidden" name="filter" value="{{ request('filter') }}">
      <button type="submit" class="btn">Search</button>
      <a href="{{ route('books.index') }}" class="btn">Clear</a>
    </form>
    <ul>
      <div class="filter-container mb-6 flex">
       @php 
       $filters = [
       '' => 'Latest',
       'popular_last_month'=>'Popular Last Month',
       'popular_last_6_months'=>'Popular Last 6 Months', 
       'highest_rated_last_month'=>'Highest Rated Last Month',
       'highest_rated_last_6_months'=>'Highest Rated Last 6 Months',   
       ];
       @endphp

       @foreach ($filters as $key => $label)
       <a href="{{route('books.index', ['filter'=>$key])}}"
        class="{{ request('filter') === $key || (request('filter')==null && $key=='') ? 'filter-item-active' : 'filter-item' }}">
        {{ $label }}
       </a>
        @endforeach
        </div>

        @forelse ($books as $book)
      <li class="mb-4">
        <div class="book-item">
          <div
            class="flex flex-wrap items-center justify-between">
            <div class="w-full flex-grow sm:w-auto">
              <span class="book-author">{{ $book->title }}</span>
            </div>
            <div>
              <div class="book-rating">
                {{ number_format($book->reviews_avg_rating, 1) }}
              </div>
              <div class="book-review-count">
                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
              </div>
            </div>
          </div>
        </div>
      </li>
    @empty
      <li class="mb-4">
        <div class="empty-book-item">
          <p class="empty-text">No books found</p>
          <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
        </div>
      </li>
    @endforelse
    </ul>
@endsection