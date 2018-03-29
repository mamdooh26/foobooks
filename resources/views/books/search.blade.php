{{-- /resources/views/books/search.blade.php --}}
@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/books/search'>

        <fieldset>
            <label for='searchTerm'>Search by title:</label>
            <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm }}'>

            <input type='checkbox' name='caseSensitive' {{($caseSensitive) ? 'checked' : ''}}>
            <label>case sensitive</label>
        </fieldset>

        <input type='submit' value='Search' class='btn btn-primary btn-small'>

    </form>

    @if($searchTerm)
        <h2>Results for query: <em>{{ $searchTerm }}</em></h2>

        @if(count($searchResults) == 0)
            No matches found.
        @else
            @foreach($searchResults as $title => $book)
                <div class='book'>
                    <h3>{{ $title }}</h3>
                    <h4>by {{ $book['author'] }}</h4>
                    <img src='{{ $book['cover_url'] }}' alt='Cover image for the book {{ $title }}'>
                </div>
            @endforeach
        @endif
    @endif
@endsection