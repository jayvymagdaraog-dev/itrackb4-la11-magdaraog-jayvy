@extends('layouts.app')

@section('title', $movie['title'])

@section('content')
     <div class="card">
        <div class="card-body">
            <h2 class="card-title"> {{ $movie['title'] }} </h2>
                <p class="card-text">Genre: {{ $movie->genre->name }}</p>
                <p class="card-text">Rating: {{ $movie['rating'] }}</p>
                <p class="card-text">Year: {{ $movie['year'] }}</p>
                <p class="card-text">Prepared by: Jayvy P. Magdaraog</p>
     <a href="{{ route('movies.index') }}" class="btn btn-dark">Back to list</a>
    </div>
</div>
@endsection