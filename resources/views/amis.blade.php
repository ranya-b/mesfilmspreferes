@extends('layouts.app')

@section('title', 'Mes amis')

@section('content')
<div class="container">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;">
        <h1 style="margin:0;">Mes amis</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFriendModal">
            <i class="bi bi-person-plus me-2"></i>Ajouter
        </button>
    </div>

    @if(isset($amis) && $amis->count() > 0)
        <div class="row g-4">
            @foreach($amis as $ami)
            <div class="col-md-6 col-lg-4">
                <div class="card-luxe" style="padding:24px;">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
                        <div style="width:52px;height:52px;border:1px solid rgba(201,168,76,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-person" style="font-size:22px;color:var(--or);"></i>
                        </div>
                        <div style="min-width:0;">
                            <h3 style="font-size:18px;margin-bottom:2px;color:var(--blanc);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ $ami->username ?? $ami->firstname . ' ' . $ami->lastname }}
                            </h3>
                            <p style="color:var(--blanc-3);font-size:12px;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $ami->email ?? '' }}</p>
                        </div>
                    </div>
                    <form action="{{ route('amis.destroy', $ami->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-danger-ghost" style="width:100%;padding:8px;">
                            <i class="bi bi-person-dash me-1"></i>Retirer
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

    @else
        <div style="text-align:center;padding:80px 32px;border:1px solid rgba(201,168,76,0.1);border-radius:8px;">
            <i class="bi bi-people" style="font-size:40px;color:var(--or);opacity:0.3;display:block;margin-bottom:20px;"></i>
            <h2 style="font-size:26px;margin-bottom:10px;">Aucun ami pour le moment</h2>
            <p style="color:var(--blanc-3);max-width:360px;margin:0 auto 28px;">Ajoutez des amis pour partager vos films préférés.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFriendModal">
                <i class="bi bi-person-plus me-2"></i>Ajouter un ami
            </button>
        </div>
    @endif
</div>

{{-- Modal --}}
<div class="modal fade" id="addFriendModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background:var(--noir-2);border:1px solid rgba(201,168,76,0.2);border-radius:8px;">
            <div class="modal-header" style="border-bottom:1px solid rgba(201,168,76,0.1);padding:24px 28px 16px;">
                <h2 class="modal-title" style="font-size:22px;font-family:'Cormorant Garamond',serif;font-weight:400;color:var(--blanc);">Ajouter un ami</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity:0.4;filter:invert(1) sepia(1) saturate(1) hue-rotate(10deg);"></button>
            </div>
            <div class="modal-body" style="padding:24px 28px 28px;">
                <form action="{{ route('amis.add') }}" method="POST">
                    @csrf
                    <div style="margin-bottom:20px;">
                        <label>Nom d'utilisateur ou email</label>
                        <input type="text" name="username" class="form-control" placeholder="ex: john_doe" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;padding:13px;">
                        <i class="bi bi-person-plus me-2"></i>Ajouter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
