<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            [
                'name' => 'K-Pop',
                'slug' => 'k-pop',
                'description' => 'From BTS to NewJeans, experience the global phenomenon of Korean pop music with infectious beats, stunning choreography, and unforgettable visuals.',
                'icon' => '✨',
                'popularity' => true,
            ],
            [
                'name' => 'Rock',
                'slug' => 'rock',
                'description' => 'From classic rock to modern alternative, explore the powerful world of rock music with iconic guitar riffs and unforgettable anthems.',
                'icon' => '🎸',
                'popularity' => false,
            ],
            [
                'name' => 'Pop',
                'slug' => 'pop',
                'description' => 'Catchy melodies, chart-topping hits, and the biggest names in popular music. Discover your next favorite earworm.',
                'icon' => '🎤',
                'popularity' => false,
            ],
            [
                'name' => 'Hip Hop / Rap',
                'slug' => 'hip-hop-rap',
                'description' => 'Beats, rhymes, and flow. Experience the culture and artistry of hip hop from old school legends to today\'s hottest artists.',
                'icon' => '🎧',
                'popularity' => false,
            ],
        ];

        foreach ($genres as $genreData) {
            Genre::create($genreData);
        }

        // Create artists - K-pop focused first
        $artists = [
            ['name' => 'BTS', 'slug' => 'bts'],
            ['name' => 'BLACKPINK', 'slug' => 'blackpink'],
            ['name' => 'NewJeans', 'slug' => 'newjeans'],
            ['name' => 'Stray Kids', 'slug' => 'stray-kids'],
            ['name' => 'TWICE', 'slug' => 'twice'],
            ['name' => 'SEVENTEEN', 'slug' => 'seventeen'],
            ['name' => 'IVE', 'slug' => 'ive'],
            ['name' => 'LE SSERAFIM', 'slug' => 'le-sserafim'],
            ['name' => 'NCT', 'slug' => 'nct'],
            ['name' => 'EXO', 'slug' => 'exo'],
        ];

        foreach ($artists as $artistData) {
            Artist::create($artistData);
        }

        // K-pop songs
        $songs = [
            ['genre' => 'k-pop', 'artist' => 'BTS', 'title' => 'Dynamite', 'album' => 'BE', 'duration' => '3:19'],
            ['genre' => 'k-pop', 'artist' => 'BTS', 'title' => 'Butter', 'album' => 'Butter (Single)', 'duration' => '2:44'],
            ['genre' => 'k-pop', 'artist' => 'BTS', 'title' => 'Boy With Luv', 'album' => 'Map of the Soul: Persona', 'duration' => '3:49'],
            ['genre' => 'k-pop', 'artist' => 'BLACKPINK', 'title' => 'Pink Venom', 'album' => 'BORN PINK', 'duration' => '3:06'],
            ['genre' => 'k-pop', 'artist' => 'BLACKPINK', 'title' => 'How You Like That', 'album' => 'THE ALBUM', 'duration' => '3:01'],
            ['genre' => 'k-pop', 'artist' => 'NewJeans', 'title' => 'Super Shy', 'album' => 'Get Up', 'duration' => '2:34'],
            ['genre' => 'k-pop', 'artist' => 'NewJeans', 'title' => 'Ditto', 'album' => 'OMG', 'duration' => '3:06'],
            ['genre' => 'k-pop', 'artist' => 'NewJeans', 'title' => 'Hype Boy', 'album' => 'New Jeans', 'duration' => '2:59'],
            ['genre' => 'k-pop', 'artist' => 'Stray Kids', 'title' => 'S-Class', 'album' => '5-STAR', 'duration' => '3:14'],
            ['genre' => 'k-pop', 'artist' => 'Stray Kids', 'title' => 'God\'s Menu', 'album' => 'GO生', 'duration' => '3:07'],
            ['genre' => 'k-pop', 'artist' => 'TWICE', 'title' => 'Set Me Free', 'album' => 'Ready To Be', 'duration' => '3:03'],
            ['genre' => 'k-pop', 'artist' => 'TWICE', 'title' => 'The Feels', 'album' => 'Formula of Love: O+T=<3', 'duration' => '3:18'],
            ['genre' => 'k-pop', 'artist' => 'SEVENTEEN', 'title' => 'Super', 'album' => 'FML', 'duration' => '3:20'],
            ['genre' => 'k-pop', 'artist' => 'IVE', 'title' => 'I AM', 'album' => 'I\'ve IVE', 'duration' => '3:21'],
            ['genre' => 'k-pop', 'artist' => 'LE SSERAFIM', 'title' => 'Perfect Night', 'album' => 'Perfect Night (Single)', 'duration' => '2:56'],
        ];

        foreach ($songs as $songData) {
            $genre = Genre::where('slug', $songData['genre'])->first();
            $artist = Artist::where('slug', $songData['artist'])->first();

            if ($genre && $artist) {
                Song::create([
                    'genre_id' => $genre->id,
                    'artist_id' => $artist->id,
                    'title' => $songData['title'],
                    'album' => $songData['album'],
                    'duration' => $songData['duration'],
                    'popularity_score' => rand(500, 5000),
                ]);
            }
        }
    }
}