<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Jayvy Movie List</h1>

    <h2 class="mb-4">Edit Movie</h2>

    <form action="{{ route('movies.update', $movie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title"
                   class="form-control"
                   placeholder="Enter movie title"
                   value="{{ old('title', $movie->title) }}" required>

            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="genre_id" class="form-label">Genre</label>
            <select name="genre_id" id="genre_id" class="form-select" required>
                <option value="">Select Genre</option>

                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}"
                        @selected(old('genre_id', $movie->genre_id) == $genre->id)>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>

            @error('genre_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" name="rating" id="rating"
                   class="form-control"
                   placeholder="Enter rating (0-10)"
                   min="0" max="10" step="0.1"
                   value="{{ old('rating', $movie->rating) }}" required>

            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" name="year" id="year"
                   class="form-control"
                   placeholder="Enter year"
                   min="1900" max="2030"
                   value="{{ old('year', $movie->year) }}" required>

            @error('year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Movie</button>

        <a href="{{ route('movies.index') }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>

    <p class="mt-4">Prepared by: Jayvy P. Magdaraog</p>
</div>

</body>
</html>
