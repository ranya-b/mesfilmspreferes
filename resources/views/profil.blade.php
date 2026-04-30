@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container">

    <h1 style="margin-bottom:40px;">Mon profil</h1>

    <div style="max-width:560px;">
        @if(auth()->check())

            {{-- Avatar + infos --}}
            <div style="display:flex;align-items:center;gap:24px;margin-bottom:40px;padding-bottom:32px;border-bottom:1px solid rgba(201,168,76,0.15);">
                <div style="width:80px;height:80px;border:1px solid rgba(201,168,76,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-person" style="font-size:36px;color:var(--or);"></i>
                </div>
                <div>
                    <h2 style="font-size:26px;margin-bottom:4px;">
                        {{ auth()->user()->username ?? auth()->user()->firstname . ' ' . auth()->user()->lastname }}
                    </h2>
                    <p style="color:var(--or);font-size:13px;letter-spacing:0.08em;margin:0;">{{ auth()->user()->email }}</p>
                </div>
            </div>

            {{-- Formulaire --}}
            <form action="{{ route('profil.update') }}" method="POST">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label>Prénom</label>
                        <input type="text" name="firstname" class="form-control" value="{{ auth()->user()->firstname ?? '' }}" required>
                    </div>
                    <div>
                        <label>Nom</label>
                        <input type="text" name="lastname" class="form-control" value="{{ auth()->user()->lastname ?? '' }}" required>
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" value="{{ auth()->user()->username ?? '' }}" required>
                </div>

                <div style="margin-bottom:16px;">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>

                <div style="margin-bottom:32px;">
                    <label>Nouveau mot de passe <span style="color:var(--blanc-3);font-size:10px;letter-spacing:0.08em;">(laisser vide pour ne pas changer)</span></label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;padding:14px;">
                    <i class="bi bi-check2 me-2"></i>Mettre à jour
                </button>
            </form>

        @else
            <div style="text-align:center;padding:48px;border:1px solid rgba(201,168,76,0.1);border-radius:8px;">
                <p style="color:var(--blanc-3);margin-bottom:20px;">Veuillez vous connecter pour voir votre profil.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
            </div>
        @endif
    </div>
</div>
@endsection
