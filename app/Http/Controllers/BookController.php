<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;

class BookController extends Controller
{
    public function index() {
        return view('books.index');
    }

    public function show($title) {
        return view('books.show')->with(['title' => $title]);
    }

    /**
     * GET /books/search
     * @Todo: change to search in the database not in jason file
     */

    public function search(Request $request){
        #$searchTerm = $_GET['searchTerm'];
        #dump($searchTerm);
        #dump($request ->input('searchTerm'));
        #dump($request -> all());
        #dump($request ->has('caseSensitive'));
        #dump($request ->fullUrl());

        # Start with an empty array of search results; books that
        # match our search query will get added to this array
        $searchResults = [];

        # Store the searchTerm in a variable for easy access
        # The second parameter (null) is what the variable
        # will be set to *if* searchTerm is not in the request.
        $searchTerm = $request->input('searchTerm', null);

        # Only try and search *if* there's a searchTerm
        if ($searchTerm) {
            # Open the books.json data file
            # database_path() is a Laravel helper to get the path to the database folder
            # See https://laravel.com/docs/helpers for other path related helpers
            $booksRawData = file_get_contents(database_path('/books.json'));

            # Decode the book JSON data into an array
            # Nothing fancy here; just a built in PHP method
            $books = json_decode($booksRawData, true);

            # Loop through all the book data, looking for matches
            # This code was taken from v0 of foobooks we built earlier in the semester
            foreach ($books as $title => $book) {
                # Case sensitive boolean check for a match
                if ($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                    # Case insensitive boolean check for a match
                } else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }

                # If it was a match, add it to our results
                if ($match) {
                    $searchResults[$title] = $book;
                }
            }
        }
        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('books.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $this ->validate($request,[
        'title'=>'required|alpha_num',
        ]);
        #dump($request -> all());
        log::info('Add the book '.$request->input('title'));
        return redirect('/books');
    }
}