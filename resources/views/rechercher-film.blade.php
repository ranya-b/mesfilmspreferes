@extends('layouts.app')

@section('title', 'Rechercher un film')

@section('content')
<div class="container">

    <div style="text-align:center;margin-bottom:48px;">
        <div style="display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:20px;">
            <div style="height:1px;width:40px;background:linear-gradient(to right,transparent,var(--or));opacity:0.5;"></div>
            <span style="font-size:11px;letter-spacing:0.2em;text-transform:uppercase;color:var(--or);">TMDB</span>
            <div style="height:1px;width:40px;background:linear-gradient(to left,transparent,var(--or));opacity:0.5;"></div>
        </div>
        <h1 style="font-size:clamp(32px,5vw,56px);margin-bottom:12px;">Rechercher un film</h1>
        <p style="color:var(--blanc-3);font-size:15px;">Des millions de titres à portée de main</p>
    </div>

    <div style="max-width:680px;margin:0 auto 56px;">
        <form action="{{ route('rechercherFilmPost') }}" method="POST">
            @csrf
            <div style="display:flex;gap:12px;">
                <input type="text" name="query" class="form-control"
                       placeholder="Titre, réalisateur, acteur..."
                       value="{{ old('query') }}" required
                       style="flex:1;font-size:15px;padding:14px 20px;">
                <button class="btn btn-primary" type="submit" style="white-space:nowrap;padding:14px 28px;">
                    <i class="bi bi-search me-2"></i>Chercher
                </button>
            </div>
        </form>
    </div>

    @if(isset($error))
        <div style="text-align:center;padding:40px;border:1px solid rgba(180,60,60,0.2);border-radius:8px;background:rgba(180,60,60,0.05);">
            <i class="bi bi-exclamation-triangle" style="font-size:32px;color:#c06060;display:block;margin-bottom:12px;"></i>
            <p style="color:#c06060;margin:0;">{{ $error }}</p>
        </div>

    @elseif(isset($results) && count($results) > 0)
        <div class="divider-or"></div>
        <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:28px;margin-top:40px;">
            <h2 style="font-size:28px;margin:0;">
                {{ request('query') ? 'Résultats' : 'Films populaires' }}
            </h2>
            <span style="font-size:12px;letter-spacing:0.1em;text-transform:uppercase;color:var(--blanc-3);">{{ count($results) }} titres</span>
        </div>

        <div class="row g-4">
            @foreach($results as $film)
            <div class="col-md-6 col-lg-4">
                <div class="card-luxe" style="height:100%;display:flex;flex-direction:column;">
                    <a href="{{ route('film.detail', $film['id']) }}" style="display:block;position:relative;overflow:hidden;">
                        @if(isset($film['poster_path']) && $film['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}"
                                 alt="{{ $film['title'] ?? $film['name'] }}"
                                 style="width:100%;height:380px;object-fit:cover;transition:transform 0.4s ease;display:block;">
                        @else
                            <div style="width:100%;height:380px;background:var(--noir-4);display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-film" style="font-size:48px;color:var(--blanc-3);opacity:0.3;"></i>
                            </div>
                        @endif
                        <div class="poster-overlay" style="position:absolute;inset:0;background:rgba(0,0,0,0);transition:background 0.3s ease;display:flex;align-items:center;justify-content:center;">
                            <span class="voir-detail" style="background:rgba(201,168,76,0.9);color:var(--noir);padding:8px 18px;border-radius:2px;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;font-weight:500;opacity:0;transition:opacity 0.3s ease;">
                                Voir le détail
                            </span>
                        </div>
                    </a>

                    <div style="padding:20px;flex:1;display:flex;flex-direction:column;border-top:1px solid rgba(201,168,76,0.08);">
                        <a href="{{ route('film.detail', $film['id']) }}" style="text-decoration:none;">
                            <h3 style="font-size:19px;margin-bottom:4px;color:var(--blanc);line-height:1.3;">{{ $film['title'] ?? $film['name'] }}</h3>
                        </a>
                        @if(isset($film['release_date']) && $film['release_date'])
                            <p style="color:var(--or);font-size:12px;letter-spacing:0.1em;margin-bottom:10px;">{{ date('Y', strtotime($film['release_date'])) }}</p>
                        @endif
                        @if(isset($film['overview']) && $film['overview'])
                            <p style="color:var(--blanc-3);font-size:13px;line-height:1.6;margin-bottom:16px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;flex:1;">{{ $film['overview'] }}</p>
                        @endif

                        <form action="{{ route('favoris.add') }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <input type="hidden" name="film_id" value="{{ $film['id'] }}">
                            <input type="hidden" name="film_title" value="{{ $film['title'] ?? $film['name'] }}">
                            <input type="hidden" name="film_poster_path" value="{{ $film['poster_path'] ?? '' }}">
                            <input type="hidden" name="film_year" value="{{ isset($film['release_date']) ? date('Y', strtotime($film['release_date'])) : '' }}">
                            <input type="hidden" name="film_overview" value="{{ $film['overview'] ?? '' }}">
                            <button type="submit" class="btn btn-primary" style="width:100%;font-size:11px;padding:10px;">
                                <i class="bi bi-heart me-2"></i>Ajouter aux favoris
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @elseif(isset($results) && count($results) === 0)
        <div style="text-align:center;padding:64px 32px;border:1px solid rgba(201,168,76,0.1);border-radius:8px;">
            <i class="bi bi-search" style="font-size:40px;color:var(--blanc-3);opacity:0.3;display:block;margin-bottom:16px;"></i>
            <h2 style="font-size:24px;margin-bottom:8px;">Aucun résultat</h2>
            <p style="color:var(--blanc-3);">Essayez avec d'autres mots-clés.</p>
        </div>
    @endif
</div>

<style>
a:hover .poster-overlay { background: rgba(0,0,0,0.45) !important; }
a:hover .voir-detail { opacity: 1 !important; }
a:hover img { transform: scale(1.04); }
</style>
@endsection
