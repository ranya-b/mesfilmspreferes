@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="container">

    {{-- Hero --}}
    <div style="text-align:center;padding:48px 0 72px;position:relative;">

        {{-- Ligne décorative --}}
        <div style="display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:32px;">
            <div style="height:1px;width:48px;background:linear-gradient(to right,transparent,var(--or));opacity:0.6;"></div>
            <span style="font-size:11px;letter-spacing:0.22em;text-transform:uppercase;color:var(--or);font-family:'DM Sans',sans-serif;font-weight:400;">Votre cinémathèque personnelle</span>
            <div style="height:1px;width:48px;background:linear-gradient(to left,transparent,var(--or));opacity:0.6;"></div>
        </div>

        <h1 style="font-size:clamp(42px,6vw,80px);font-weight:300;margin-bottom:24px;line-height:1.05;">
            Bienvenue sur Mes Films Préférés
        </h1>

        <p style="font-size:16px;color:var(--blanc-3);max-width:480px;margin:0 auto 40px;line-height:1.8;">
            Explorez des millions de films, constituez votre collection personnelle et partagez vos coups de cœur avec vos amis.
        </p>

        <a href="{{ route('rechercherFilm') }}" class="btn btn-primary" style="padding:14px 40px;font-size:12px;letter-spacing:0.18em;">
            <i class="bi bi-search me-2"></i>Explorer les films
        </a>
    </div>

    {{-- Divider --}}
    <div class="divider-or"></div>

    {{-- Cards --}}
    <div class="row g-4" style="padding:48px 0 32px;">

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('rechercherFilm') }}" style="display:block;text-decoration:none;">
                <div class="card-luxe" style="padding:32px;height:100%;">
                    <div style="width:44px;height:44px;border:1px solid rgba(201,168,76,0.3);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <i class="bi bi-search" style="color:var(--or);font-size:18px;"></i>
                    </div>
                    <h3 style="font-size:24px;margin-bottom:12px;color:var(--blanc);">Rechercher</h3>
                    <p style="color:var(--blanc-3);font-size:14px;line-height:1.7;margin-bottom:24px;">
                        Parcourez des millions de titres grâce à l'API TMDB et trouvez votre prochain film préféré.
                    </p>
                    <span style="font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--or);">
                        Explorer <i class="bi bi-arrow-right ms-1"></i>
                    </span>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('favoris') }}" style="display:block;text-decoration:none;">
                <div class="card-luxe" style="padding:32px;height:100%;">
                    <div style="width:44px;height:44px;border:1px solid rgba(201,168,76,0.3);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <i class="bi bi-heart" style="color:var(--or);font-size:18px;"></i>
                    </div>
                    <h3 style="font-size:24px;margin-bottom:12px;color:var(--blanc);">Favoris</h3>
                    <p style="color:var(--blanc-3);font-size:14px;line-height:1.7;margin-bottom:24px;">
                        Constituez votre collection personnelle et laissez des avis sur chaque film que vous avez vu.
                    </p>
                    <span style="font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--or);">
                        Ma collection <i class="bi bi-arrow-right ms-1"></i>
                    </span>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('amis.index') }}" style="display:block;text-decoration:none;">
                <div class="card-luxe" style="padding:32px;height:100%;">
                    <div style="width:44px;height:44px;border:1px solid rgba(201,168,76,0.3);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <i class="bi bi-people" style="color:var(--or);font-size:18px;"></i>
                    </div>
                    <h3 style="font-size:24px;margin-bottom:12px;color:var(--blanc);">Amis</h3>
                    <p style="color:var(--blanc-3);font-size:14px;line-height:1.7;margin-bottom:24px;">
                        Connectez-vous avec vos amis, partagez vos découvertes et échangez autour du cinéma.
                    </p>
                    <span style="font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--or);">
                        Mes amis <i class="bi bi-arrow-right ms-1"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
.card-luxe a { color: var(--or); }
</style>
@endsection
