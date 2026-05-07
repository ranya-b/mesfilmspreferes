<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --noir:      #0a0a0a;
            --noir-2:    #111111;
            --noir-3:    #1a1a1a;
            --noir-4:    #242424;
            --noir-5:    #2e2e2e;
            --or:        #c9a84c;
            --or-clair:  #e2c97e;
            --or-sombre: #8a6d2f;
            --blanc:     #f5f0e8;
            --blanc-2:   #d4cfc4;
            --blanc-3:   #8a8478;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--noir); color: var(--blanc); font-family: 'Outfit', sans-serif; font-weight: 300; font-size: 15px; line-height: 1.7; padding-top: 72px; min-height: 100vh; background-image: radial-gradient(ellipse 80% 50% at 50% -10%, rgba(201,168,76,0.06) 0%, transparent 60%); }
        a { color: var(--or); text-decoration: none; transition: color 0.2s ease; }
        a:hover { color: var(--or-clair); }
        p { color: var(--blanc-3); }
        h1, h2, h3 { font-family: 'Outfit', serif; font-weight: 300; color: var(--blanc); letter-spacing: 0.02em; }
        h1 { font-size: 56px; line-height: 1.1; margin-bottom: 32px; }
        h2 { font-size: 32px; margin-bottom: 16px; font-weight: 400; }
        h3 { font-size: 22px; font-weight: 400; }
        label { display: block; font-size: 11px; font-weight: 400; letter-spacing: 0.12em; text-transform: uppercase; color: var(--blanc-3); margin-bottom: 8px; }

        /* NAVBAR */
        .navbar { background: rgba(10,10,10,0.92); backdrop-filter: blur(24px) saturate(150%); -webkit-backdrop-filter: blur(24px) saturate(150%); border-bottom: 1px solid rgba(201,168,76,0.15); height: 72px; padding: 0; position: fixed; top: 0; left: 0; right: 0; z-index: 1000; }
        .navbar .container-fluid { max-width: 1280px; margin: 0 auto; padding: 0 32px; height: 100%; display: flex; align-items: center; }
        .navbar-brand { font-family: 'Outfit', serif; font-weight: 400; font-size: 22px; letter-spacing: 0.18em; text-transform: uppercase; color: var(--or) !important; margin-right: 48px; transition: color 0.3s ease; flex-shrink: 0; }
        .navbar-brand:hover { color: var(--or-clair) !important; }
        .navbar-nav { gap: 4px; }
        .nav-link { font-family: 'Outfit', sans-serif; font-weight: 300; font-size: 13px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--blanc-2) !important; padding: 8px 14px !important; border-radius: 4px; transition: all 0.25s ease; position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: 4px; left: 14px; right: 14px; height: 1px; background: var(--or); transform: scaleX(0); transition: transform 0.25s ease; transform-origin: left; }
        .nav-link:hover { color: var(--or-clair) !important; }
        .nav-link:hover::after { transform: scaleX(1); }
        .nav-link i { font-size: 13px; opacity: 0.6; margin-right: 6px; }
        .navbar-toggler { border: 1px solid rgba(201,168,76,0.3); border-radius: 4px; padding: 6px 10px; }
        .navbar-toggler:focus { box-shadow: 0 0 0 2px rgba(201,168,76,0.2); }
        .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(201,168,76,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e"); }
        @media (max-width: 991px) { .navbar-collapse { background: var(--noir-2); border: 1px solid rgba(201,168,76,0.15); border-radius: 8px; padding: 16px; margin-top: 8px; } }

        /* LAYOUT */
        .container { max-width: 1100px; margin: 0 auto; padding: 56px 32px; background: transparent; }
        @media (max-width: 767px) { .container { padding: 40px 16px; } }
        main { animation: fadeUp 0.5s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

        /* FORMS */
        .form-control, .form-select { background: var(--noir-3); border: 1px solid rgba(201,168,76,0.2); border-radius: 4px; color: var(--blanc); padding: 12px 16px; font-family: 'Outfit', sans-serif; font-size: 14px; font-weight: 300; transition: all 0.2s ease; }
        .form-control:focus, .form-select:focus { background: var(--noir-3); border-color: var(--or); box-shadow: 0 0 0 3px rgba(201,168,76,0.1); color: var(--blanc); outline: none; }
        .form-control::placeholder { color: var(--blanc-3); }
        select.form-control option, .form-select option { background: var(--noir-3); color: var(--blanc); }
        textarea.form-control { resize: none; }

        /* BUTTONS */
        .btn-primary { background: linear-gradient(135deg, var(--or-sombre), var(--or)); border: none; border-radius: 4px; color: var(--noir); font-family: 'Outfit', sans-serif; font-size: 12px; font-weight: 500; letter-spacing: 0.14em; text-transform: uppercase; padding: 12px 28px; transition: all 0.3s ease; box-shadow: 0 2px 12px rgba(201,168,76,0.2); }
        .btn-primary:hover { background: linear-gradient(135deg, var(--or), var(--or-clair)); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,168,76,0.3); color: var(--noir); }
        .btn-primary:active { transform: translateY(0); color: var(--noir); }
        .btn-ghost { background: transparent; border: 1px solid rgba(201,168,76,0.3); border-radius: 4px; color: var(--or); font-family: 'Outfit', sans-serif; font-size: 12px; font-weight: 400; letter-spacing: 0.12em; text-transform: uppercase; padding: 10px 24px; transition: all 0.25s ease; cursor: pointer; }
        .btn-ghost:hover { background: rgba(201,168,76,0.08); border-color: var(--or); color: var(--or-clair); }
        .btn-danger-ghost { background: transparent; border: 1px solid rgba(180,60,60,0.3); border-radius: 4px; color: #c06060; font-family: 'Outfit', sans-serif; font-size: 12px; font-weight: 400; letter-spacing: 0.1em; text-transform: uppercase; padding: 8px 16px; transition: all 0.25s ease; cursor: pointer; }
        .btn-danger-ghost:hover { background: rgba(180,60,60,0.1); border-color: #c06060; color: #e08080; }
        .btn-link { background: none; border: none; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-weight: 300; font-size: 13px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--blanc-2); cursor: pointer; transition: color 0.25s ease; border-radius: 4px; position: relative; }
        .btn-link::after { content: ''; position: absolute; bottom: 4px; left: 14px; right: 14px; height: 1px; background: var(--or); transform: scaleX(0); transition: transform 0.25s ease; transform-origin: left; }
        .btn-link:hover { color: var(--or-clair); }
        .btn-link:hover::after { transform: scaleX(1); }
        .btn-toggle { background: none; border: 1px dashed rgba(201,168,76,0.25); border-radius: 4px; padding: 8px 12px; font-size: 13px; color: var(--blanc-3); cursor: pointer; width: 100%; transition: all 0.2s ease; font-family: 'Outfit', sans-serif; }
        .btn-toggle:hover { border-color: var(--or); color: var(--or); }
        .btn-annuler { background: var(--noir-4); border: 1px solid rgba(201,168,76,0.15); border-radius: 4px; padding: 8px 14px; font-size: 13px; color: var(--blanc-3); cursor: pointer; font-family: 'Outfit', sans-serif; transition: all 0.2s ease; }
        .btn-annuler:hover { color: var(--blanc); }

        /* CARDS */
        .card-luxe { background: var(--noir-2); border: 1px solid rgba(201,168,76,0.1); border-radius: 8px; overflow: hidden; transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; }
        .card-luxe:hover { border-color: rgba(201,168,76,0.35); transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(201,168,76,0.15); }
        .card-inner { padding: 24px; }
        .card-inner-lg { padding: 32px; }
        .card-form { background: var(--noir-2); border: 1px solid rgba(201,168,76,0.12); border-radius: 8px; padding: 32px; }

        /* BADGES */
        .badge-or { background: rgba(201,168,76,0.15); border: 1px solid rgba(201,168,76,0.3); color: var(--or-clair); font-size: 11px; letter-spacing: 0.1em; text-transform: uppercase; padding: 4px 10px; border-radius: 2px; display: inline-block; }
        .badge-genre { background: var(--noir-4); color: var(--blanc); padding: 4px 12px; border-radius: 20px; font-size: 13px; }
        .badge-note { background: rgba(201,168,76,0.15); border: 1px solid rgba(201,168,76,0.3); color: var(--or-clair); padding: 4px 12px; border-radius: 2px; font-size: 13px; letter-spacing: 0.08em; }
        .badge-favori { background: rgba(201,168,76,0.08); border-radius: 4px; padding: 8px 14px; font-size: 13px; color: var(--or-clair); display: inline-flex; align-items: center; gap: 8px; }

        /* ICONS */
        .icon-box { width: 44px; height: 44px; border: 1px solid rgba(201,168,76,0.3); border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: var(--or); font-size: 18px; flex-shrink: 0; }
        .icon-box-lg { width: 64px; height: 64px; border: 1px solid rgba(201,168,76,0.3); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; color: var(--or); font-size: 28px; flex-shrink: 0; }
        .icon-circle { border-radius: 50% !important; }
        .icon-box-avatar { width: 52px; height: 52px; border: 1px solid rgba(201,168,76,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--or); font-size: 22px; }
        .icon-box-avatar-lg { width: 80px; height: 80px; border: 1px solid rgba(201,168,76,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--or); font-size: 36px; }

        /* HERO */
        .page-hero { text-align: center; padding: 48px 0 72px; }
        .page-header { text-align: center; margin-bottom: 48px; }
        .hero-label { display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 32px; }
        .hero-label-line { height: 1px; width: 48px; opacity: 0.6; }
        .hero-label-line-left  { background: linear-gradient(to right, transparent, var(--or)); }
        .hero-label-line-right { background: linear-gradient(to left,  transparent, var(--or)); }
        .hero-label-text { font-size: 11px; letter-spacing: 0.22em; text-transform: uppercase; color: var(--or); }
        .hero-title { font-size: clamp(42px, 6vw, 80px); font-weight: 300; margin-bottom: 24px; line-height: 1.05; }
        .hero-title em { color: var(--or); font-style: italic; }
        .hero-subtitle { font-size: 16px; color: var(--blanc-3); max-width: 480px; margin: 0 auto 40px; line-height: 1.8; }
        .page-title-fluid { font-size: clamp(32px, 5vw, 56px); margin-bottom: 12px; }

        /* DIVIDERS */
        .divider-or { height: 1px; background: linear-gradient(90deg, transparent, var(--or), transparent); margin: 32px 0; opacity: 0.4; }
        .divider-card { border-top: 1px solid rgba(201,168,76,0.1); margin: 24px 0 0; padding-top: 24px; }

        /* ALERTS */
        .alert { border-radius: 4px; border: none; padding: 14px 20px; font-size: 13px; letter-spacing: 0.04em; }
        .alert-success { background: rgba(201,168,76,0.08); color: var(--or-clair); border-left: 2px solid var(--or); }
        .alert-danger  { background: rgba(180,60,60,0.08);  color: #e08080; border-left: 2px solid #c06060; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 80px 32px; border: 1px solid rgba(201,168,76,0.1); border-radius: 8px; }
        .empty-state i { font-size: 40px; color: var(--or); opacity: 0.3; display: block; margin-bottom: 20px; }

        /* POSTER / FILM CARDS */
        .poster-wrap { display: block; position: relative; overflow: hidden; }
        .poster-img { width: 100%; object-fit: cover; transition: transform 0.4s ease; display: block; }
        .poster-h-film   { height: 380px; }
        .poster-h-favori { height: 360px; }
        .poster-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0); transition: background 0.3s ease; display: flex; align-items: center; justify-content: center; }
        .poster-overlay-label { background: rgba(201,168,76,0.9); color: var(--noir); padding: 8px 18px; border-radius: 2px; font-size: 11px; letter-spacing: 0.14em; text-transform: uppercase; font-weight: 500; opacity: 0; transition: opacity 0.3s ease; }
        .poster-wrap:hover .poster-overlay { background: rgba(0,0,0,0.45); }
        .poster-wrap:hover .poster-overlay-label { opacity: 1; }
        .poster-wrap:hover .poster-img { transform: scale(1.04); }
        .poster-placeholder { width: 100%; background: var(--noir-4); display: flex; align-items: center; justify-content: center; }
        .poster-placeholder i { font-size: 48px; color: var(--blanc-3); opacity: 0.3; }
        .card-body-film { padding: 20px; flex: 1; display: flex; flex-direction: column; border-top: 1px solid rgba(201,168,76,0.08); }

        /* FILM DETAIL */
        .film-detail-wrap { background: var(--noir-2); border: 1px solid rgba(201,168,76,0.12); border-radius: 12px; overflow: hidden; }
        .film-detail-backdrop { position: relative; height: 320px; overflow: hidden; }
        .film-detail-backdrop img { width: 100%; height: 100%; object-fit: cover; }
        .film-detail-backdrop-gradient { position: absolute; inset: 0; background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.7) 100%); }
        .film-detail-body { padding: 32px; display: flex; gap: 32px; align-items: flex-start; }
        .film-detail-poster { flex-shrink: 0; width: 180px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); margin-top: -80px; position: relative; z-index: 1; }
        .film-detail-info { flex: 1; min-width: 0; }
        .film-detail-meta { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; align-items: center; }
        .film-detail-meta-item { color: var(--blanc-3); font-size: 14px; }
        .film-detail-genres { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
        .film-detail-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 8px; }
        .film-detail-casting { padding: 0 32px 32px; }
        .film-detail-casting-grid { display: flex; flex-wrap: wrap; gap: 12px; }
        .info-box { background: var(--noir-4); border-radius: 4px; padding: 10px 16px; font-size: 13px; color: var(--blanc-3); display: flex; align-items: center; gap: 8px; }
        @media (max-width: 640px) { .film-detail-body { flex-direction: column; } .film-detail-poster { margin-top: 0; width: 140px; } }

        /* CAST */
        .cast-card { background: var(--noir-4); border-radius: 8px; padding: 12px; font-size: 13px; text-align: center; min-width: 110px; }
        .cast-card img { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; display: block; margin: 0 auto 8px; }
        .cast-card-placeholder { width: 52px; height: 52px; border-radius: 50%; background: var(--noir-5); display: flex; align-items: center; justify-content: center; margin: 0 auto 8px; color: var(--blanc-3); font-size: 20px; }
        .cast-name { font-weight: 500; color: var(--blanc); font-size: 13px; }
        .cast-role { color: var(--blanc-3); font-size: 11px; margin-top: 2px; }

        /* PARTAGES */
        .partage-poster { width: 72px; height: 108px; object-fit: cover; border-radius: 4px; flex-shrink: 0; }
        .partage-poster-placeholder { width: 72px; height: 108px; background: var(--noir-4); border-radius: 4px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .quote-block { border-left: 2px solid var(--or); padding: 10px 16px; background: rgba(201,168,76,0.05); border-radius: 0 4px 4px 0; }
        .quote-block p { font-style: italic; font-size: 13px; line-height: 1.6; margin: 0; color: var(--blanc-3); }

        /* AVIS & FORM PANELS */
        .avis-block { background: var(--noir-4); border-radius: 6px; padding: 10px 14px; margin-bottom: 12px; font-size: 14px; color: var(--blanc); line-height: 1.5; }
        .form-panel { background: var(--noir-4); border-radius: 6px; padding: 14px; margin-top: 10px; }

        /* MODAL */
        .modal-content { background: var(--noir-2); border: 1px solid rgba(201,168,76,0.2); border-radius: 8px; }
        .modal-header { border-bottom: 1px solid rgba(201,168,76,0.1); padding: 24px 28px 16px; }
        .modal-body { padding: 24px 28px 28px; }
        .modal-title { font-size: 22px; font-family: 'Outfit', serif; font-weight: 400; color: var(--blanc); }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--noir); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--or); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('accueil') }}">Mes Films Préférés</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('rechercherFilm') }}"><i class="bi bi-search"></i>Rechercher</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('favoris') }}"><i class="bi bi-heart"></i>Favoris</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('amis.index') }}"><i class="bi bi-people"></i>Amis</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('partages.index') }}"><i class="bi bi-share"></i>Partages</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('profil.show') }}"><i class="bi bi-person-circle"></i>Profil</a></li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i>Connexion</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('creerCompte') }}"><i class="bi bi-person-plus"></i>Créer un compte</a></li>
                    @else
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn-link nav-link" type="submit"><i class="bi bi-box-arrow-right"></i>Déconnexion</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @if(session('success'))
            <div class="container" style="padding-bottom:0;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="filter:invert(1) sepia(1) saturate(2) hue-rotate(10deg);opacity:0.6;"></button>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container" style="padding-bottom:0;">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="opacity:0.6;"></button>
                </div>
            </div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
