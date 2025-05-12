@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header clr-yellow">Bejelentkezés</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-4 col-form-label text-end">E-mail cím</label>
                            <div class="col-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-4 col-form-label text-end">Jelszó</label>
                            <div class="col-6 flex flex-row">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                                <button type="button" class="fs-3 mx-2" id="showPassButton">
                                    <i class="bi bi-eye-slash-fill clr-gray" id="showPassIcon"></i>
                                </button>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Emlékezz rám</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-orange clr-black font-large">
                                    Bejelentkezés
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
            <div class="row justify-items-center mt-3">
                <a href="{{ route('register') }}" class="btn btn-link clr-yellow">Nincs fiókod? Regisztrálj!</a>
            </div>
        </div>
    </div>
</div>
@endsection
