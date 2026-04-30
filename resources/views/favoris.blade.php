@extends('layouts.app')

@section('title', 'Mes favoris')

@section('content')
<div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;">
        <h1>Mes favoris</h1>
        <a href="{{ route('rechercherFilm') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Ajouter un film
        </a>
    </div>

    @if(isset($favoris) && $favoris->count() > 0)
        <div class="row g-4">
            @foreach($favoris as $favori)
            <div class="col-md-6 col-lg-4">
                <div style="background:var(--noir-2);border-radius:8px;overflow:hidden;border:1px solid rgba(201,168,76,0.1);transition:transform 0.2s ease,box-shadow 0.2s ease;height:100%;display:flex;flex-direction:column;">

                    {{-- Affiche cliquable --}}
                    <a href="{{ route('film.detail', $favori->favori_id) }}" style="display:block;position:relative;overflow:hidden;">
                        @if($favori->film_poster_path)
                            <img src="https://image.tmdb.org/t/p/w500{{ $favori->film_poster_path }}"
                                 alt="{{ $favori->film_title }}"
                                 style="width:100%;height:360px;object-fit:cover;transition:transform 0.3s ease;">
                        @else
                            <div style="width:100%;height:360px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-film" style="font-size:64px;color:white;opacity:0.5;"></i>
                            </div>
                        @endif
                        <div style="position:absolute;inset:0;background:rgba(0,0,0,0);transition:background 0.2s ease;display:flex;align-items:center;justify-content:center;" class="poster-overlay">
                            <span style="background:var(--noir-2);color:var(--blanc);padding:8px 16px;border-radius:20px;font-size:14px;font-weight:500;opacity:0;transition:opacity 0.2s ease;" class="voir-detail">
                                <i class="bi bi-eye me-1"></i>Voir le détail
                            </span>
                        </div>
                    </a>

                    <div style="padding:20px;flex:1;display:flex;flex-direction:column;">
                        <a href="{{ route('film.detail', $favori->favori_id) }}" style="text-decoration:none;">
                            <h3 style="font-size:18px;font-weight:600;margin-bottom:4px;color:var(--blanc);">{{ $favori->film_title }}</h3>
                        </a>
                        @if($favori->film_year)
                            <p style="color:var(--blanc-3);font-size:14px;margin-bottom:12px;">{{ $favori->film_year }}</p>
                        @endif

                        {{-- Avis actuel --}}
                        @if($favori->avis)
                            <div style="background:var(--noir-4);border-radius:6px;padding:10px 14px;margin-bottom:12px;font-size:14px;color:var(--blanc);line-height:1.5;">
                                <i class="bi bi-chat-quote me-1" style="color:var(--or);"></i>{{ $favori->avis }}
                            </div>
                        @endif

                        {{-- Formulaire avis (toggle) --}}
                        <div style="margin-bottom:12px;">
                            <button onclick="toggleAvis({{ $favori->id }})"
                                    style="background:none;border:1px dashed #d2d2d7;border-radius:8px;padding:6px 12px;font-size:13px;color:var(--blanc-3);cursor:pointer;width:100%;transition:all 0.2s;"
                                    id="btn-avis-{{ $favori->id }}">
                                <i class="bi bi-pencil me-1"></i>{{ $favori->avis ? 'Modifier mon avis' : 'Ajouter un avis' }}
                            </button>

                            <div id="form-avis-{{ $favori->id }}" style="display:none;margin-top:10px;">
                                <form action="{{ route('favoris.updateAvis', $favori->id) }}" method="POST">
                                    @csrf
                                    <textarea name="avis"
                                              class="form-control"
                                              rows="3"
                                              placeholder="Votre avis sur ce film..."
                                              style="font-size:14px;margin-bottom:8px;resize:none;">{{ $favori->avis }}</textarea>
                                    <div style="display:flex;gap:8px;">
                                        <button type="submit" class="btn btn-primary" style="flex:1;font-size:14px;padding:8px;">
                                            <i class="bi bi-check me-1"></i>Enregistrer
                                        </button>
                                        <button type="button" onclick="toggleAvis({{ $favori->id }})"
                                                style="background:var(--noir-4);border:none;border-radius:8px;padding:8px 12px;font-size:14px;cursor:pointer;">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Supprimer --}}
                        <form action="{{ route('favoris.destroy', $favori->id) }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <button type="submit" class="btn" style="width:100%;background:var(--noir-4);color:var(--blanc);border:none;border-radius:8px;padding:8px;font-size:14px;">
                                <i class="bi bi-trash me-1"></i>Supprimer
                            </button>
                        </form>

                        {{-- Partager --}}
                        <div style="margin-top:8px;">
                            <button onclick="togglePartage({{ $favori->id }})"
                                    style="background:none;border:1px dashed #d2d2d7;border-radius:8px;padding:6px 12px;font-size:13px;color:var(--blanc-3);cursor:pointer;width:100%;transition:all 0.2s;">
                                <i class="bi bi-share me-1"></i>Partager ce film
                            </button>
                            <div id="form-partage-{{ $favori->id }}" style="display:none;margin-top:10px;background:var(--noir-4);border-radius:6px;padding:14px;">
                                @if(isset($amis) && $amis->count() > 0)
                                    <form action="{{ route('partages.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="favori_id" value="{{ $favori->id }}">
                                        <div style="margin-bottom:10px;">
                                            <label style="font-size:13px;margin-bottom:4px;">Partager avec</label>
                                            <select name="friend_id" class="form-control" style="font-size:13px;">
                                                @foreach($amis as $ami)
                                                    <option value="{{ $ami->id }}">{{ $ami->username }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="margin-bottom:10px;">
                                            <label style="font-size:13px;margin-bottom:4px;">Message (optionnel)</label>
                                            <textarea name="message" class="form-control" rows="2" placeholder="Un message..." style="font-size:13px;resize:none;"></textarea>
                                        </div>
                                        <div style="display:flex;gap:8px;">
                                            <button type="submit" class="btn btn-primary" style="flex:1;font-size:13px;padding:6px;">
                                                <i class="bi bi-send me-1"></i>Envoyer
                                            </button>
                                            <button type="button" onclick="togglePartage({{ $favori->id }})"
                                                    style="background:var(--noir-2);border:none;border-radius:8px;padding:6px 10px;font-size:13px;cursor:pointer;">
                                                Annuler
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <p style="color:var(--blanc-3);font-size:13px;margin:0;">
                                        <i class="bi bi-people me-1"></i>
                                        Aucun ami. <a href="{{ route('amis.index') }}">Ajouter des amis</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:64px 32px;background:var(--noir-2);border-radius:8px;border:1px solid rgba(201,168,76,0.1);">
            <div style="width:80px;height:80px;background:linear-gradient(135deg,#ec4899,#f472b6);border-radius:20px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:24px;">
                <i class="bi bi-heart" style="font-size:40px;color:white;"></i>
            </div>
            <h2 style="font-size:28px;font-weight:600;margin-bottom:12px;color:var(--blanc);">Aucun favori pour le moment</h2>
            <p style="color:var(--blanc-3);font-size:17px;margin-bottom:32px;">Commencez à ajouter vos films préférés à votre collection.</p>
            <a href="{{ route('rechercherFilm') }}" class="btn btn-primary">
                <i class="bi bi-search me-2"></i>Rechercher un film
            </a>
        </div>
    @endif
</div>

<style>
a:hover .poster-overlay { background: rgba(0,0,0,0.35) !important; }
a:hover .voir-detail { opacity: 1 !important; }
a:hover img { transform: scale(1.03); }
</style>

<script>
function toggleAvis(id) {
    const form = document.getElementById('form-avis-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
function togglePartage(id) {
    const form = document.getElementById('form-partage-' + id);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
