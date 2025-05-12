@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Új jelszó megerősítése</div>

                <div class="card-body">
                    <p class="clr-orange font-large">Kérjük, hogy erősítsd meg jelszavad mielőtt továbblépnél.</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="passwordConfirm" class="col-md-4 col-form-label text-md-end">Jelszó megerősítése</label>
                            <div class="col-md-6">
                                <input id="passwordConfirm" type="password" class="form-control @error('passwordConfirm') is-invalid @enderror" 
                                name="passwordConfirm" required autocomplete="passwordConfirm">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-yellow clr-black font-large">
                                    Megerősítés
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link clr-gray" href="{{ route('password.request') }}">
                                        Elfelejtetted a jelszavad?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
