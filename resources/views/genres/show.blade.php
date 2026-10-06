@extends('layouts.app')

@section('title', $genre->name)

@section('content')
<div class="space-y-8">
    {{-- Genre Header --}}
    <header class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-pink-500 via-rose-500 to-fuchsia-600 p-6 md:p-10 text-white">
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3 flex-wrap">
                        <span class="px-3 py-1 text-sm font-medium bg-white/20 backdrop-blur-sm rounded-full">
                            {{ $genre->songs_count ?? 0 }} Songs
                        </span>
                        @if ($genre->popularity)
                            <span class="px-3 py-1 text-sm font-medium bg-amber-500/90 text-white rounded-full flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Trending
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight mb-3">
                        {{ $genre->name }}
                    </h1>
                    <p class="text-lg text-white/90 max-w-2xl leading-relaxed">
                        {{ $genre->description }}
                    </p>
                </div>
                <div class="hidden md:block relative">
                    <div class="aspect-square w-48 md:w-64 mx-auto bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20">
                        <span class="text-7xl md:text-9xl opacity-90">{{ $genre->icon ?? '✨' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-pink-500/20 via-transparent to-transparent"></div>
    </header>

    {{-- Songs List --}}
    <section>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">
                Songs in {{ $genre->name }}
            </h2>
            <div class="flex items-center gap-2">
                <label for="sort" class="text-sm text-gray-600 dark:text-gray-400 hidden sm:block">Sort:</label>
                <select id="sort" wire:model="sort" class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    <option value="popular">Most Popular</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="az">A-Z</option>
                    <option value="za">Z-A</option>
                </select>
            </div>
        </div>

        @if ($songs->isEmpty())
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                <span class="text-6xl mb-4 block">{{ $genre->icon ?? '🎵' }}</span>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">No songs yet</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Songs will be added soon.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($songs as $song)
                    <article class="group bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg hover:border-pink-200 dark:hover:border-pink-800 transition-all duration-300">
                        <div class="aspect-square relative bg-gradient-to-br from-pink-100 to-rose-100 dark:from-pink-900/30 dark:to-rose-900/30 overflow-hidden">
                            @if ($song->cover_image)
                                <img src="{{ $song->cover_image }}" alt="{{ $song->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-5xl opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300">🎵</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <button class="w-12 h-12 rounded-full bg-white text-pink-600 flex items-center justify-center hover:bg-white/90 transition-colors transform group-hover:scale-110 transition-transform duration-300 shadow-xl" aria-label="Play {{ $song->title }}">
                                    <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                </button>
                            </div>
                            @if ($song->is_explicit)
                                <span class="absolute top-2 right-2 px-1.5 py-0.5 text-xs font-medium bg-red-600 text-white rounded">E</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-1 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors line-clamp-1">
                                {{ $song->title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $song->artist }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500">
                                @if ($song->album)
                                    <span>{{ $song->album }}</span>
                                @endif
                                <span>{{ $song->duration ?? '3:45' }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $songs->links() }}
            </div>
        @endif
    </section>
</div>
@endsection