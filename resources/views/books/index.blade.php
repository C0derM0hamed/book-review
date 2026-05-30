@extends('layouts.app')
@section('content')
    <h1>Books</h1>
    <ul>
        @foreach ($books as $book)
            <li>{{ $book->title }}</li>
        @endforeach
    </ul>
@endsection