<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\User;
use App\Models\FriendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Vérifier si le film est déjà en favori
        $favori = Favori::where('user_id', Auth::id())
            ->where('favori_id', $id)
            ->first();

        // Récupérer les amis
        $userId = Auth::id();
        $amis = User::whereIn('id', function($query) use ($userId) {
            $query->select('friend_id')->from('friend_user')->where('user_id', $userId);
        })->orWhereIn('id', function($query) use ($userId) {
            $query->select('user_id')->from('friend_user')->where('friend_id', $userId);
        })->where('id', '!=', $userId)->get();

        return view('film-detail', compact('film', 'director', 'cast', 'favori', 'amis'));
    }
}
