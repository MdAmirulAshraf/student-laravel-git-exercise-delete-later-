@extends('layouts.app')

@section('title', 'Browse Genres')

@section('content')
<div class="space-y-10">
    {{-- Hero Section - K-Pop Featured --}}
    @php($kpop = $genres->firstWhere('slug', 'k-pop'))
    @if ($kpop)
    <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-pink-500 via-rose-500 to-fuchsia-600 p-8 md:p-16 text-white">
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8">
                <div class="flex-1">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-sm text-sm font-medium mb-4">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-300 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-300"></span>
                        </span>
                        Trending Now
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                        {{ $kpop->name }}
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 max-w-2xl mb-6 leading-relaxed">
                        {{ $kpop->description }}
                    </p>
                    <a href="{{ route('genres.show', $kpop->slug) }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-white text-pink-600 font-semibold rounded-xl hover:bg-white/90 transition-colors shadow-lg hover:shadow-xl">
                        Explore K-Pop Songs
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
                <div class="hidden md:block relative">
                    <div class="aspect-square max-w-md mx-auto bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20">
                        <span class="text-8xl md:text-9xl opacity-90">{{ $kpop->icon ?? '✨' }}</span>
                    </div>
                    <div class="absolute -bottom-4 -right-4 md:-bottom-8 md:-right-8 w-24 h-24 bg-pink-400/30 rounded-full blur-3xl"></div>
                    <div class="absolute -top-4 -left-4 md:-top-8 md:-left-8 w-32 h-32 bg-fuchsia-400/30 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Other Genres Grid --}}
    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                More Genres
            </h2>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                {{ $genres->count() - 1 }} more to explore
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($genres->where('slug', '!=', 'k-pop') as $genre)
                <article class="group relative bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition-all duration-300">
                    <div class="aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-5xl md:text-6xl opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300">{{ $genre->icon ?? '🎵' }}</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @if ($genre->popularity)
                            <span class="absolute top-3 left-3 px-2 py-1 text-xs font-medium bg-amber-500 text-white rounded-full">Popular</span>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-1 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors">
                            {{ $genre->name }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-3">
                            {{ $genre->description }}
                        </p>
                        <a href="{{ route('genres.show', $genre->slug) }}"
                           class="inline-flex items-center text-sm font-medium text-pink-600 dark:text-pink-400 hover:text-pink-700 dark:hover:text-pink-300 transition-colors">
                            Browse
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400 mb-4">
            Don't see your favorite genre?
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-500">
            More genres coming soon. Stay tuned!
        </p>
    </section>
</div>
@endsection