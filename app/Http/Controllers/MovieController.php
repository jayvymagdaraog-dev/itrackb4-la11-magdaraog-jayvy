<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
   public function index(Request $request)
{
    $genreId = $request->query('genre_id');
    $year = $request->query('year');

    $genres = Genre::all();

    $query = Movie::with('genre');

    if ($genreId) {
        $query = $query->where('genre_id', $genreId);
    }

    if ($year) {
        $query = $query->where('year', $year);
    }

    $movies = $query->get();

    return view('movies.index', compact('movies', 'genres', 'genreId', 'year'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $genres = Genre::all();

    return view('movies.create', compact('genres'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:100',
        'genre_id' => 'required|exists:genres,id',
        'rating' => 'required|numeric|min:0|max:10',
        'year' => 'required|integer|min:1900|max:2030',
    ]);

    Movie::create($validated);

    return redirect()->route('movies.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        
        return view('movies.show', compact('movie'));
    
    }

    
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:100',
        'genre_id' => 'required|exists:genres,id',
        'rating' => 'required|numeric|min:0|max:10',
        'year' => 'required|integer|min:1900|max:2030',
    ]);

    $movie->update($validated);

    return redirect()->route('movies.index')
    ->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()
        ->route('movies.index')
        ->with('success', 'Movie deleted successfully');
    }

    /**
     * Filter movies by genre.
     */
    public function filter($genre = null)
    {
        $movies = $this->movies();
        if ($genre) {
            $movies = array_filter($movies, function ($movie) use ($genre) {
                return $movie['genre'] === $genre;
            });
        }

        return view('movies.filter', ['movies' => $movies, 'activeGenre' => $genre]);
    }

    private function movies()
    {
        $path = storage_path('movies.json');

        return json_decode(file_get_contents($path), true);
    }

    private function saveMovies(array $movies){
        file_put_contents(
            storage_path('movies.json'),
            json_encode($movies, JSON_PRETTY_PRINT)
        );
    }

}