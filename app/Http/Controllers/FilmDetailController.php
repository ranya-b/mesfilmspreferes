<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmDetailController extends Controller
{
    public function show($id)
    {
        $apiKey = env('TMDB_API_KEY', '63905b28b94957ba2d061a85b849243f');

        try {
            $filmJson = file_get_contents(
                "https://api.themoviedb.org/3/movie/{$id}?api_key={$apiKey}&language=fr-FR"
            );
            $film = json_decode($filmJson, true);

            $creditsJson = file_get_contents(
                "https://api.themoviedb.org/3/movie/{$id}/credits?api_key={$apiKey}&language=fr-FR"
            );
            $credits = json_decode($creditsJson, true);

            $director = collect($credits['crew'] ?? [])
                ->firstWhere('job', 'Director');

            $cast = array_slice($credits['cast'] ?? [], 0, 6);

        } catch (\Exception $e) {
            abort(404);
        }

        if (isset($film['status_message'])) {
            abort(404);
        }

        return view('film-detail', compact('film', 'director', 'cast'));
    }
}
