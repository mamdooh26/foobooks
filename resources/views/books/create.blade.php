@extends('layouts.master')

@section('title')
    New book
@endsection

@section('content')
    <h1>Add a new book</h1>

    <form method='POST' action='/foobooks/public/books'>
        {{ csrf_field() }}

        <fieldset>
            <label for='title'>Title</label>
            <input type='text' name='title' id='title' value='{{old('title')}}'>
            @if($errors->get('title'))
                <ul>
                    @foreach($errors->get('title') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </fieldset>

        <input type='submit' value='Add book'>
    </form>

    @if(count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection