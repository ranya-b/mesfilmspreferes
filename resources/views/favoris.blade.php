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
                <div style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);transition:transform 0.2s ease,box-shadow 0.2s ease;height:100%;display:flex;flex-direction:column;">

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
                            <span style="background:white;color:#1d1d1f;padding:8px 16px;border-radius:20px;font-size:14px;font-weight:500;opacity:0;transition:opacity 0.2s ease;" class="voir-detail">
                                <i class="bi bi-eye me-1"></i>Voir le détail
                            </span>
                        </div>
                    </a>

                    <div style="padding:20px;flex:1;display:flex;flex-direction:column;">
                        <a href="{{ route('film.detail', $favori->favori_id) }}" style="text-decoration:none;">
                            <h3 style="font-size:18px;font-weight:600;margin-bottom:4px;color:#1d1d1f;">{{ $favori->film_title }}</h3>
                        </a>
                        @if($favori->film_year)
                            <p style="color:#86868b;font-size:14px;margin-bottom:12px;">{{ $favori->film_year }}</p>
                        @endif

                        {{-- Avis actuel --}}
                        @if($favori->avis)
                            <div style="background:#f5f5f7;border-radius:10px;padding:10px 14px;margin-bottom:12px;font-size:14px;color:#1d1d1f;line-height:1.5;">
                                <i class="bi bi-chat-quote me-1" style="color:#6366f1;"></i>{{ $favori->avis }}
                            </div>
                        @endif

                        {{-- Formulaire avis (toggle) --}}
                        <div style="margin-bottom:12px;">
                            <button onclick="toggleAvis({{ $favori->id }})"
                                    style="background:none;border:1px dashed #d2d2d7;border-radius:8px;padding:6px 12px;font-size:13px;color:#86868b;cursor:pointer;width:100%;transition:all 0.2s;"
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
                                                style="background:#f5f5f7;border:none;border-radius:8px;padding:8px 12px;font-size:14px;cursor:pointer;">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Supprimer --}}
                        <form action="{{ route('favoris.destroy', $favori->id) }}" method="POST" style="margin-top:auto;">
                            @csrf
                            <button type="submit" class="btn" style="width:100%;background:#f5f5f7;color:#1d1d1f;border:none;border-radius:8px;padding:8px;font-size:14px;">
                                <i class="bi bi-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:64px 32px;background:white;border-radius:16px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
            <div style="width:80px;height:80px;background:linear-gradient(135deg,#ec4899,#f472b6);border-radius:20px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:24px;">
                <i class="bi bi-heart" style="font-size:40px;color:white;"></i>
            </div>
            <h2 style="font-size:28px;font-weight:600;margin-bottom:12px;color:#1d1d1f;">Aucun favori pour le moment</h2>
            <p style="color:#86868b;font-size:17px;margin-bottom:32px;">Commencez à ajouter vos films préférés à votre collection.</p>
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
</script>
@endsection
