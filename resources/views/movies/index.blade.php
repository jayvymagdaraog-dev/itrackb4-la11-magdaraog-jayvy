
@extends('layouts.app')

@section('title', 'Movie List')

@section('content')

    <h2 class="mb-3">All Movies</h2>

    <div class="mb-3">
        <a href="{{ route('movies.create') }}" class="btn btn-success">
            Add New Movie
        </a>
    </div>

    <form action="{{ route('movies.index') }}" method="GET" class="mb-3">

        <select name="genre_id" class="form-select w-auto">
            <option value="">All Genres</option>

            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}"
                    @selected($genreId == $genre->id)>
                    {{ $genre->name }}
                </option>
            @endforeach

        </select>

        <button type="submit" class="btn btn-primary btn-sm mt-2">
            Filter
        </button>

    </form>

    <div class="mb-3">
        <strong>Year:</strong>
        @foreach ([2023, 2017, 2018, 2012, 2014] as $y)
            <a href="{{ route('movies.index', ['genre_id' => $genreId, 'year' => $y]) }}"
               class="btn btn-outline-primary btn-sm me-1">
                {{ $y }}
            </a>
        @endforeach

        <a href="{{ route('movies.index') }}"
           class="btn btn-secondary btn-sm ms-2">
            Clear all filters
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>
                            <a href="{{ route('movies.show', $movie->id) }}">
                                {{ $movie->title }}
                            </a>
                        </td>

                        <td>{{ $movie->genre->name }}</td>

                        <td>{{ $movie->rating }}</td>
                        <td>
                            {{ $movie->year }}
                            @if ($movie->year >= 2020)
                                <span class="badge bg-success">New Release</span>
                            @else
                                <span class="badge bg-secondary">Classic</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST"
                                onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No movies found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 mb-3 text-start">
        <p>Prepared by: Jayvy P. Magdaraog</p>
    </div>

@endsection
