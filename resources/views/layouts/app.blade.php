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
            --noir: #0a0a0a;
            --noir-2: #111111;
            --noir-3: #1a1a1a;
            --noir-4: #242424;
            --noir-5: #2e2e2e;
            --or: #c9a84c;
            --or-clair: #e2c97e;
            --or-sombre: #8a6d2f;
            --blanc: #f5f0e8;
            --blanc-2: #d4cfc4;
            --blanc-3: #8a8478;
            --accent: #c9a84c;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            background-color: var(--noir);
            color: var(--blanc);
            font-family: 'Outfit', sans-serif;
            font-weight: 300;
            font-size: 15px;
            line-height: 1.7;
            padding-top: 72px;
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -10%, rgba(201,168,76,0.06) 0%, transparent 60%),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='400' height='400' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: rgba(10,10,10,0.92);
            backdrop-filter: blur(24px) saturate(150%);
            -webkit-backdrop-filter: blur(24px) saturate(150%);
            border-bottom: 1px solid rgba(201,168,76,0.15);
            height: 72px;
            padding: 0;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
        }

        .navbar .container-fluid {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 32px;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .navbar-brand {
            font-family: 'Outfit', serif;
            font-weight: 400;
            font-size: 22px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--or) !important;
            text-decoration: none;
            margin-right: 48px;
            transition: color 0.3s ease;
            flex-shrink: 0;
        }

        .navbar-brand:hover { color: var(--or-clair) !important; }

        .navbar-nav { gap: 4px; }

        .nav-link {
            font-family: 'Outfit', sans-serif;
            font-weight: 300;
            font-size: 13px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--blanc-2) !important;
            padding: 8px 14px !important;
            border-radius: 4px;
            transition: all 0.25s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 14px; right: 14px;
            height: 1px;
            background: var(--or);
            transform: scaleX(0);
            transition: transform 0.25s ease;
            transform-origin: left;
        }

        .nav-link:hover {
            color: var(--or-clair) !important;
        }

        .nav-link:hover::after { transform: scaleX(1); }

        .nav-link i { font-size: 13px; opacity: 0.6; margin-right: 6px; }

        .navbar-toggler {
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 4px;
            padding: 6px 10px;
            color: var(--or);
        }
        .navbar-toggler:focus { box-shadow: 0 0 0 2px rgba(201,168,76,0.2); }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(201,168,76,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: var(--noir-2);
                border: 1px solid rgba(201,168,76,0.15);
                border-radius: 8px;
                padding: 16px;
                margin-top: 8px;
            }
        }

        /* ─── LAYOUT ─── */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 56px 32px;
            background: transparent;
        }

        @media (max-width: 767px) {
            .container { padding: 40px 16px; }
        }

        /* ─── TYPOGRAPHY ─── */
        h1 {
            font-family: 'Outfit', serif;
            font-weight: 300;
            font-size: 56px;
            line-height: 1.1;
            letter-spacing: 0.02em;
            color: var(--blanc);
            margin-bottom: 32px;
        }

        h1 .gold { color: var(--or); }

        h2 {
            font-family: 'Outfit', serif;
            font-weight: 400;
            font-size: 32px;
            color: var(--blanc);
            margin-bottom: 16px;
            letter-spacing: 0.02em;
        }

        h3 {
            font-family: 'Outfit', serif;
            font-weight: 400;
            font-size: 22px;
            color: var(--blanc);
        }

        p { color: var(--blanc-3); }

        label {
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--blanc-3);
            display: block;
            margin-bottom: 8px;
        }

        /* ─── FORMS ─── */
        .form-control, .form-select {
            background: var(--noir-3);
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 4px;
            color: var(--blanc);
            padding: 12px 16px;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 300;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            background: var(--noir-3);
            border-color: var(--or);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
            color: var(--blanc);
            outline: none;
        }

        .form-control::placeholder { color: var(--blanc-3); }

        select.form-control option, .form-select option {
            background: var(--noir-3);
            color: var(--blanc);
        }

        textarea.form-control { resize: none; }

        /* ─── BUTTONS ─── */
        .btn-primary {
            background: linear-gradient(135deg, var(--or-sombre), var(--or));
            border: none;
            border-radius: 4px;
            color: var(--noir);
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 12px 28px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(201,168,76,0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--or), var(--or-clair));
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(201,168,76,0.3);
            color: var(--noir);
        }

        .btn-primary:active { transform: translateY(0); color: var(--noir); }

        .btn-ghost {
            background: transparent;
            border: 1px solid rgba(201,168,76,0.3);
            border-radius: 4px;
            color: var(--or);
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 10px 24px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .btn-ghost:hover {
            background: rgba(201,168,76,0.08);
            border-color: var(--or);
            color: var(--or-clair);
        }

        .btn-danger-ghost {
            background: transparent;
            border: 1px solid rgba(180,60,60,0.3);
            border-radius: 4px;
            color: #c06060;
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 8px 16px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .btn-danger-ghost:hover {
            background: rgba(180,60,60,0.1);
            border-color: #c06060;
            color: #e08080;
        }

        /* ─── CARDS ─── */
        .card-luxe {
            background: var(--noir-2);
            border: 1px solid rgba(201,168,76,0.1);
            border-radius: 8px;
            overflow: hidden;
            transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-luxe:hover {
            border-color: rgba(201,168,76,0.35);
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.5), 0 0 0 1px rgba(201,168,76,0.15);
        }

        /* ─── DIVIDER ─── */
        .divider-or {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--or), transparent);
            margin: 32px 0;
            opacity: 0.4;
        }

        /* ─── ALERT ─── */
        .alert {
            border-radius: 4px;
            border: none;
            padding: 14px 20px;
            font-size: 13px;
            letter-spacing: 0.04em;
        }

        .alert-success {
            background: rgba(201,168,76,0.08);
            color: var(--or-clair);
            border-left: 2px solid var(--or);
        }

        .alert-danger {
            background: rgba(180,60,60,0.08);
            color: #e08080;
            border-left: 2px solid #c06060;
        }

        /* ─── NAV LINK BTN ─── */
        .btn-link {
            background: none;
            border: none;
            padding: 8px 14px;
            font-family: 'Outfit', sans-serif;
            font-weight: 300;
            font-size: 13px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--blanc-2);
            cursor: pointer;
            transition: color 0.25s ease;
            border-radius: 4px;
            position: relative;
        }

        .btn-link::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 14px; right: 14px;
            height: 1px;
            background: var(--or);
            transform: scaleX(0);
            transition: transform 0.25s ease;
            transform-origin: left;
        }

        .btn-link:hover { color: var(--or-clair); }
        .btn-link:hover::after { transform: scaleX(1); }

        /* ─── BADGE OR ─── */
        .badge-or {
            background: rgba(201,168,76,0.15);
            border: 1px solid rgba(201,168,76,0.3);
            color: var(--or-clair);
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 2px;
            display: inline-block;
        }

        /* ─── SCROLLBAR ─── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--noir); }
        ::-webkit-scrollbar-thumb { background: rgba(201,168,76,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--or); }

        /* ─── LIENS ─── */
        a { color: var(--or); text-decoration: none; transition: color 0.2s ease; }
        a:hover { color: var(--or-clair); }

        /* ─── PAGE FADE IN ─── */
        main { animation: fadeUp 0.5s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                Mes Films Préférés
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rechercherFilm') }}">
                            <i class="bi bi-search"></i>Rechercher
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favoris') }}">
                            <i class="bi bi-heart"></i>Favoris
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('amis.index') }}">
                            <i class="bi bi-people"></i>Amis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('partages.index') }}">
                            <i class="bi bi-share"></i>Partages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profil.show') }}">
                            <i class="bi bi-person-circle"></i>Profil
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i>Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('creerCompte') }}">
                                <i class="bi bi-person-plus"></i>Créer un compte
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn-link nav-link" type="submit">
                                    <i class="bi bi-box-arrow-right"></i>Déconnexion
                                </button>
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
