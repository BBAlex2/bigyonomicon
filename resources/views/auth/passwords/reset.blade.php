@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header clr-yellow">Új jelszó</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row mb-3">
                            <label for="email" class="col-4 col-form-label text-end">E-mail cím</label>
                            <div class="col-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="newPassword" class="col-4 col-form-label text-end">Új jelszó</label>
                            <div class="col-6">
                                <input id="newPassword" type="newPassword" class="form-control @error('newPassword') is-invalid @enderror" 
                                name="newPassword" required autocomplete="newPassword">

                                @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="passwordConfirm" class="col-4 col-form-label text-end">Jelszó megerősítése</label>
                            <div class="col-6">
                                <input id="passwordConfirm" type="password" class="form-control" 
                                name="passwordConfirm" required autocomplete="passwordConfirm">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Jelszó felülírása
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
