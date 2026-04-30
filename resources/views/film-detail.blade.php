@extends('layouts.app')

@section('title', $film['title'] ?? 'Détail du film')

@section('content')
<div class="container">

    <a href="javascript:history.back()" style="display:inline-flex;align-items:center;gap:6px;color:#86868b;font-size:15px;text-decoration:none;margin-bottom:32px;">
        <i class="bi bi-arrow-left"></i> Retour
    </a>

    <div style="background:white;border-radius:20px;overflow:hidden;box-shadow:0 2px 16px rgba(0,0,0,0.08);">

        {{-- Bannière --}}
        @if(isset($film['backdrop_path']) && $film['backdrop_path'])
            <div style="position:relative;height:320px;overflow:hidden;">
                <img src="https://image.tmdb.org/t/p/w1280{{ $film['backdrop_path'] }}"
                     alt="{{ $film['title'] }}"
                     style="width:100%;height:100%;object-fit:cover;">
                <div style="position:absolute;inset:0;background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.7) 100%);"></div>
            </div>
        @endif

        <div style="padding:32px;display:flex;gap:32px;align-items:flex-start;" class="film-detail-body">

            {{-- Affiche --}}
            @if(isset($film['poster_path']) && $film['poster_path'])
                <div style="flex-shrink:0;">
                    <img src="https://image.tmdb.org/t/p/w342{{ $film['poster_path'] }}"
                         alt="{{ $film['title'] }}"
                         style="width:180px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.15);margin-top:-80px;position:relative;z-index:1;">
                </div>
            @endif

            {{-- Infos --}}
            <div style="flex:1;min-width:0;">
                <h1 style="font-size:36px;margin-bottom:8px;">{{ $film['title'] }}</h1>

                <div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:20px;align-items:center;">
                    @if(isset($film['release_date']) && $film['release_date'])
                        <span style="color:#86868b;font-size:15px;">
                            <i class="bi bi-calendar3 me-1"></i>{{ date('d/m/Y', strtotime($film['release_date'])) }}
                        </span>
                    @endif
                    @if(isset($film['runtime']) && $film['runtime'])
                        <span style="color:#86868b;font-size:15px;">
                            <i class="bi bi-clock me-1"></i>{{ intdiv($film['runtime'], 60) }}h {{ $film['runtime'] % 60 }}min
                        </span>
                    @endif
                    @if(isset($film['vote_average']) && $film['vote_average'])
                        <span style="background:linear-gradient(135deg,#f59e0b,#fbbf24);color:white;padding:4px 10px;border-radius:20px;font-size:14px;font-weight:600;">
                            <i class="bi bi-star-fill me-1"></i>{{ number_format($film['vote_average'], 1) }}/10
                        </span>
                    @endif
                </div>

                @if(isset($film['genres']) && count($film['genres']))
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;">
                        @foreach($film['genres'] as $genre)
                            <span style="background:#f5f5f7;color:#1d1d1f;padding:4px 12px;border-radius:20px;font-size:14px;">{{ $genre['name'] }}</span>
                        @endforeach
                    </div>
                @endif

                @if(isset($film['overview']) && $film['overview'])
                    <p style="color:#1d1d1f;font-size:16px;line-height:1.6;margin-bottom:20px;">{{ $film['overview'] }}</p>
                @endif

                @if($director)
                    <p style="color:#86868b;font-size:15px;margin-bottom:16px;">
                        <i class="bi bi-camera-video me-1"></i>
                        <strong style="color:#1d1d1f;">Réalisateur :</strong> {{ $director['name'] }}
                    </p>
                @endif

                {{-- Bouton ajouter aux favoris --}}
                @auth
                    <form action="{{ route('favoris.add') }}" method="POST" style="display:inline-block;margin-top:8px;">
                        @csrf
                        <input type="hidden" name="film_id" value="{{ $film['id'] }}">
                        <input type="hidden" name="film_title" value="{{ $film['title'] }}">
                        <input type="hidden" name="film_poster_path" value="{{ $film['poster_path'] ?? '' }}">
                        <input type="hidden" name="film_year" value="{{ isset($film['release_date']) ? date('Y', strtotime($film['release_date'])) : '' }}">
                        <input type="hidden" name="film_overview" value="{{ $film['overview'] ?? '' }}">
                        <button type="submit" class="btn btn-primary" style="background:linear-gradient(135deg,#ec4899,#f472b6);border:none;">
                            <i class="bi bi-heart me-2"></i>Ajouter aux favoris
                        </button>
                    </form>
                @endauth
            </div>
        </div>

        {{-- Casting --}}
        @if(count($cast))
            <div style="padding:0 32px 32px;">
                <h2 style="font-size:22px;margin-bottom:16px;">Casting</h2>
                <div style="display:flex;flex-wrap:wrap;gap:12px;">
                    @foreach($cast as $actor)
                        <div style="background:#f5f5f7;border-radius:12px;padding:10px 16px;font-size:14px;text-align:center;min-width:120px;">
                            @if(isset($actor['profile_path']) && $actor['profile_path'])
                                <img src="https://image.tmdb.org/t/p/w92{{ $actor['profile_path'] }}"
                                     alt="{{ $actor['name'] }}"
                                     style="width:48px;height:48px;border-radius:50%;object-fit:cover;display:block;margin:0 auto 8px;">
                            @else
                                <div style="width:48px;height:48px;border-radius:50%;background:#d2d2d7;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;">
                                    <i class="bi bi-person" style="color:#86868b;font-size:20px;"></i>
                                </div>
                            @endif
                            <div style="font-weight:600;color:#1d1d1f;">{{ $actor['name'] }}</div>
                            @if(isset($actor['character']))
                                <div style="color:#86868b;font-size:12px;">{{ $actor['character'] }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<style>
@media (max-width: 640px) {
    .film-detail-body { flex-direction: column !important; }
    .film-detail-body img { margin-top: 0 !important; width: 140px !important; }
}
</style>
@endsection
