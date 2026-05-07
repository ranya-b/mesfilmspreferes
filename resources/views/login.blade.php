@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container">
    <div style="max-width:440px;margin:0 auto;">

        <div style="text-align:center;margin-bottom:40px;">
            <div style="width:64px;height:64px;border:1px solid rgba(201,168,76,0.3);border-radius:12px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:24px;">
                <i class="bi bi-box-arrow-in-right" style="font-size:28px;color:var(--or);"></i>
            </div>
            <h1 style="font-size:clamp(32px,5vw,48px);margin-bottom:10px;">Connexion</h1>
            <p style="color:var(--blanc-3);font-size:15px;">Connectez-vous à votre compte</p>
        </div>

        <div style="background:var(--noir-2);border:1px solid rgba(201,168,76,0.12);border-radius:8px;padding:32px;">
            <form action="{{ route('loginPost') }}" method="POST">
                @csrf

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom:20px;">
                        <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                    </div>
                @endif

                <div style="margin-bottom:16px;">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div style="margin-bottom:28px;">
                    <label>Mot de passe</label>
                    <input class="form-control" type="password" name="password" required>
                </div>

                <button class="btn btn-primary" type="submit" style="width:100%;padding:13px;">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
            </form>

            <div style="text-align:center;margin-top:24px;padding-top:24px;border-top:1px solid rgba(201,168,76,0.1);">
                <p style="color:var(--blanc-3);font-size:14px;margin:0;">
                    Pas encore de compte ?
                    <a href="{{ route('creerCompte') }}">Créer un compte</a>
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
