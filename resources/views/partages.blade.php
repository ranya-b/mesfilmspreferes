@extends('layouts.app')

@section('title', 'Partages')

@section('content')
<div class="container">

    <h1 style="margin-bottom:40px;">Partages</h1>

    @if(isset($partages) && $partages->count() > 0)
        <div class="row g-4">
            @foreach($partages as $partage)
            <div class="col-md-6">
                <div class="card-luxe" style="padding:24px;display:flex;flex-direction:column;gap:16px;">
                    <div style="display:flex;gap:16px;align-items:flex-start;">
                        {{-- Affiche --}}
                        @if($partage->film_poster_path)
                            <img src="https://image.tmdb.org/t/p/w200{{ $partage->film_poster_path }}"
                                 alt="{{ $partage->film_title }}"
                                 style="width:72px;height:108px;object-fit:cover;border-radius:4px;flex-shrink:0;">
                        @else
                            <div style="width:72px;height:108px;background:var(--noir-4);border-radius:4px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-film" style="color:var(--blanc-3);opacity:0.3;font-size:24px;"></i>
                            </div>
                        @endif

                        <div style="flex:1;min-width:0;">
                            <h3 style="font-size:19px;margin-bottom:4px;color:var(--blanc);line-height:1.3;">{{ $partage->film_title }}</h3>
                            <p style="color:var(--or);font-size:12px;letter-spacing:0.1em;margin-bottom:10px;">
                                <i class="bi bi-person me-1"></i>{{ $partage->user->username ?? 'Utilisateur' }}
                            </p>
                            @if($partage->message)
                                <p style="color:var(--blanc-2);font-size:13px;line-height:1.6;margin:0;">{{ $partage->message }}</p>
                            @endif
                        </div>
                    </div>

                    @if($partage->avis)
                        <div style="border-left:2px solid var(--or);padding:10px 16px;background:rgba(201,168,76,0.05);border-radius:0 4px 4px 0;">
                            <p style="color:var(--blanc-3);font-size:13px;line-height:1.6;margin:0;font-style:italic;">« {{ $partage->avis }} »</p>
                        </div>
                    @endif

                    @if(auth()->id() == $partage->user_id)
                        <form action="{{ route('partages.destroy', $partage->id) }}" method="POST" style="margin-top:4px;">
                            @csrf
                            <button type="submit" class="btn-danger-ghost" style="width:100%;padding:8px;">
                                <i class="bi bi-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

    @else
        <div style="text-align:center;padding:80px 32px;border:1px solid rgba(201,168,76,0.1);border-radius:8px;">
            <i class="bi bi-share" style="font-size:40px;color:var(--or);opacity:0.3;display:block;margin-bottom:20px;"></i>
            <h2 style="font-size:26px;margin-bottom:10px;">Aucun partage</h2>
            <p style="color:var(--blanc-3);max-width:360px;margin:0 auto;">Les films partagés par vos amis apparaîtront ici.</p>
        </div>
    @endif
</div>
@endsection
