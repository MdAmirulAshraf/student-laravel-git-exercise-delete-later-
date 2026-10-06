<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $genres = Genre::withCount('songs')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('genres.index', compact('genres'));
    }

    public function show(Genre $genre, Request $request)
    {
        $genre->loadCount('songs');

        $songs = $genre->songs()
            ->with('artist')
            ->when($request->sort, function ($query, $sort) {
                match ($sort) {
                    'newest' => $query->latest('created_at'),
                    'oldest' => $query->oldest('created_at'),
                    'az' => $query->orderBy('title'),
                    'za' => $query->orderByDesc('title'),
                    default => $query->orderByDesc('popularity_score'),
                };
            }, function ($query) {
                $query->orderByDesc('popularity_score');
            })
            ->paginate(12)
            ->withQueryString();

        return view('genres.show', compact('genre', 'songs'));
    }
}