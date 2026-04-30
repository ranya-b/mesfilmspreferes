@extends('layouts.app')

@section('title', $film['title'] ?? 'Détail du film')

@section('content')
<div class="container">

    <a href="javascript:history.back()" style="display:inline-flex;align-items:center;gap:6px;color:var(--blanc-3);font-size:15px;text-decoration:none;margin-bottom:32px;">
        <i class="bi bi-arrow-left"></i> Retour
    </a>

    <div style="background:var(--noir-2);border:1px solid rgba(201,168,76,0.12);border-radius:12px;overflow:hidden;">

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
                        <span style="color:var(--blanc-3);font-size:15px;">
                            <i class="bi bi-calendar3 me-1"></i>{{ date('d/m/Y', strtotime($film['release_date'])) }}
                        </span>
                    @endif
                    @if(isset($film['runtime']) && $film['runtime'])
                        <span style="color:var(--blanc-3);font-size:15px;">
                            <i class="bi bi-clock me-1"></i>{{ intdiv($film['runtime'], 60) }}h {{ $film['runtime'] % 60 }}min
                        </span>
                    @endif
                    @if(isset($film['vote_average']) && $film['vote_average'])
                        <span style="background:rgba(201,168,76,0.15);border:1px solid rgba(201,168,76,0.3);color:var(--or-clair);padding:4px 12px;border-radius:2px;font-size:13px;letter-spacing:0.08em;">
                            <i class="bi bi-star-fill me-1"></i>{{ number_format($film['vote_average'], 1) }}/10
                        </span>
                    @endif
                </div>

                @if(isset($film['genres']) && count($film['genres']))
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;">
                        @foreach($film['genres'] as $genre)
                            <span style="background:var(--noir-4);color:var(--blanc);padding:4px 12px;border-radius:20px;font-size:14px;">{{ $genre['name'] }}</span>
                        @endforeach
                    </div>
                @endif

                @if(isset($film['overview']) && $film['overview'])
                    <p style="color:var(--blanc);font-size:16px;line-height:1.6;margin-bottom:20px;">{{ $film['overview'] }}</p>
                @endif

                @if($director)
                    <p style="color:var(--blanc-3);font-size:15px;margin-bottom:16px;">
                        <i class="bi bi-camera-video me-1"></i>
                        <strong style="color:var(--blanc);">Réalisateur :</strong> {{ $director['name'] }}
                    </p>
                @endif

                {{-- Boutons actions --}}
                @auth
                <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:8px;">
                    @if(!$favori)
                        <form action="{{ route('favoris.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="film_id" value="{{ $film['id'] }}">
                            <input type="hidden" name="film_title" value="{{ $film['title'] }}">
                            <input type="hidden" name="film_poster_path" value="{{ $film['poster_path'] ?? '' }}">
                            <input type="hidden" name="film_year" value="{{ isset($film['release_date']) ? date('Y', strtotime($film['release_date'])) : '' }}">
                            <input type="hidden" name="film_overview" value="{{ $film['overview'] ?? '' }}">
                            <button type="submit" class="btn btn-primary" style="background:linear-gradient(135deg,var(--or-sombre),var(--or));border:none;color:var(--noir);">
                                <i class="bi bi-heart me-2"></i>Ajouter aux favoris
                            </button>
                        </form>
                        <div style="background:var(--noir-4);border-radius:12px;padding:10px 16px;font-size:14px;color:var(--blanc-3);display:flex;align-items:center;gap:8px;">
                            <i class="bi bi-info-circle"></i> Ajoutez ce film en favori pour pouvoir le partager
                        </div>
                    @else
                        <div style="background:rgba(201,168,76,0.08);border-radius:4px;padding:8px 14px;font-size:13px;color:var(--or-clair);display:flex;align-items:center;gap:8px;">
                            <i class="bi bi-heart-fill"></i> Dans vos favoris
                        </div>
                        <button onclick="togglePartage()" class="btn btn-primary" style="background:linear-gradient(135deg,var(--or-sombre),var(--or));border:none;color:var(--noir);">
                            <i class="bi bi-share me-2"></i>Partager ce film
                        </button>
                    @endif
                </div>

                @if($favori)
                <div id="form-partage" style="display:none;background:var(--noir-4);border-radius:12px;padding:16px;margin-top:12px;">
                    @if($amis->count() > 0)
                        <form action="{{ route('partages.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="favori_id" value="{{ $favori->id }}">
                            <div style="margin-bottom:12px;">
                                <label style="font-size:14px;margin-bottom:6px;">Partager avec</label>
                                <select name="friend_id" class="form-control" style="font-size:14px;">
                                    @foreach($amis as $ami)
                                        <option value="{{ $ami->id }}">{{ $ami->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom:12px;">
                                <label style="font-size:14px;margin-bottom:6px;">Message (optionnel)</label>
                                <textarea name="message" class="form-control" rows="2" placeholder="Ajouter un message..." style="font-size:14px;resize:none;"></textarea>
                            </div>
                            <div style="display:flex;gap:8px;">
                                <button type="submit" class="btn btn-primary" style="flex:1;font-size:14px;padding:8px;">
                                    <i class="bi bi-send me-1"></i>Envoyer
                                </button>
                                <button type="button" onclick="togglePartage()" style="background:var(--noir-4);border:1px solid rgba(201,168,76,0.15);border-radius:4px;padding:8px 12px;font-size:14px;cursor:pointer;">
                                    Annuler
                                </button>
                            </div>
                        </form>
                    @else
                        <p style="color:var(--blanc-3);font-size:14px;margin:0;">
                            <i class="bi bi-people me-1"></i>
                            Vous n'avez pas encore d'amis. <a href="{{ route('amis.index') }}">Ajouter des amis</a>
                        </p>
                    @endif
                </div>
                @endif
                @endauth
            </div>
        </div>

        {{-- Casting --}}
        @if(count($cast))
            <div style="padding:0 32px 32px;">
                <h2 style="font-size:22px;margin-bottom:16px;">Casting</h2>
                <div style="display:flex;flex-wrap:wrap;gap:12px;">
                    @foreach($cast as $actor)
                        <div style="background:var(--noir-4);border-radius:12px;padding:10px 16px;font-size:14px;text-align:center;min-width:120px;">
                            @if(isset($actor['profile_path']) && $actor['profile_path'])
                                <img src="https://image.tmdb.org/t/p/w92{{ $actor['profile_path'] }}"
                                     alt="{{ $actor['name'] }}"
                                     style="width:48px;height:48px;border-radius:50%;object-fit:cover;display:block;margin:0 auto 8px;">
                            @else
                                <div style="width:48px;height:48px;border-radius:50%;background:var(--noir-5);display:flex;align-items:center;justify-content:center;margin:0 auto 8px;">
                                    <i class="bi bi-person" style="color:var(--blanc-3);font-size:20px;"></i>
                                </div>
                            @endif
                            <div style="font-weight:600;color:var(--blanc);">{{ $actor['name'] }}</div>
                            @if(isset($actor['character']))
                                <div style="color:var(--blanc-3);font-size:12px;">{{ $actor['character'] }}</div>
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
<script>
function togglePartage() {
    const form = document.getElementById('form-partage');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
