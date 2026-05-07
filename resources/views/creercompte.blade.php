@extends('layouts.app')

@section('title', 'Créer un compte')

@section('content')
<div class="container">
    <div style="max-width:440px;margin:0 auto;">

        <div style="text-align:center;margin-bottom:40px;">
            <div style="width:64px;height:64px;border:1px solid rgba(201,168,76,0.3);border-radius:12px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:24px;">
                <i class="bi bi-person-plus" style="font-size:28px;color:var(--or);"></i>
            </div>
            <h1 style="font-size:clamp(32px,5vw,48px);margin-bottom:10px;">Créer un compte</h1>
            <p style="color:var(--blanc-3);font-size:15px;">Rejoignez la communauté</p>
        </div>

        <div style="background:var(--noir-2);border:1px solid rgba(201,168,76,0.12);border-radius:8px;padding:32px;">
            <form action="{{ route('creerComptePost') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom:20px;">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <ul style="margin:6px 0 0 0;padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                    <div>
                        <label>Prénom</label>
                        <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" required autofocus>
                    </div>
                    <div>
                        <label>Nom</label>
                        <input class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" required>
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label>Nom d'utilisateur</label>
                    <input class="form-control" type="text" name="username" value="{{ old('username') }}" required>
                </div>

                <div style="margin-bottom:16px;">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div style="margin-bottom:28px;">
                    <label>Mot de passe</label>
                    <input class="form-control" type="password" name="password" required>
                </div>

                <button class="btn btn-primary" type="submit" style="width:100%;padding:13px;">
                    <i class="bi bi-person-plus me-2"></i>Créer un compte
                </button>
            </form>

            <div style="text-align:center;margin-top:24px;padding-top:24px;border-top:1px solid rgba(201,168,76,0.1);">
                <p style="color:var(--blanc-3);font-size:14px;margin:0;">
                    Déjà un compte ?
                    <a href="{{ route('login') }}">Se connecter</a>
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
