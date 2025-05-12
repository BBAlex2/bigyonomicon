@extends('layouts.app')

@section('content')
    <div class="container row">
        <div class="col-md-8 col-sm-12 mx-auto flex flex-col justify-content-center">
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="card mt-4 mb-2 justify-content-center">
                    <p class="card-header clr-yellow">Felhasználói adatok</p>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-4 col-form-label text-end">Felhasználónév</label>
                            <div class="col-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-4 col-form-label text-end">E-mail cím</label>
                            <div class="col-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                    name="password" required autocomplete="new-password">
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
                            <label for="password-confirm"
                                class="col-4 col-form-label text-end">Jelszó megerősítése</label>
                            <div class="col-6 flex flex-row">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                    required autocomplete="new-password">
                                <button type="button" class="fs-3 mx-2" id="showConfirmPassButton">
                                    <i class="bi bi-eye-slash-fill clr-gray" id="showConfirmPassIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 justify-content-center">
                    <p class="card-header clr-yellow">Számlázási információk</p>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="billingName" class="col-4 col-form-label text-end">Cég (név)</label>
                            <div class="col-6">
                                <input id="billingName" type="text" class="form-control @error('billingName') is-invalid @enderror"
                                    name="billingName" value="{{ old('billingName') }}" autocomplete="billingName">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="billingCity" class="col-4 col-form-label text-end">Város/település</label>
                            <div class="col-6">
                                <input id="billingCity" type="text" class="form-control @error('billingCity') is-invalid @enderror"
                                    name="billingCity" value="{{ old('billingCity') }}" autocomplete="billingCity">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="billingStreet" class="col-4 col-form-label text-end">Út/utca</label>
                            <div class="col-4">
                                <input id="billingStreet" type="text" class="form-control @error('billingStreet') is-invalid @enderror"
                                    name="billingStreet" value="{{ old('billingStreet') }}" autocomplete="billingStreet">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="billingStreetNum" class="col-4 col-form-label text-end">Házszám</label>
                            <div class="col-2">
                                <input id="billingStreetNum" type="number" class="form-control @error('billingStreetNum') is-invalid @enderror"
                                    name="billingStreetNum" value="{{ old('billingStreetNum') }}" autocomplete="billingStreetNum">
                            </div>
                            <label for="billingZip" class="col-2 col-form-label text-end">Irányítószám</label>
                            <div class="col-2">
                                <input id="billingZip" type="number" class="form-control @error('billingZip') is-invalid @enderror"
                                    name="billingZip" value="{{ old('billingZip') }}" required autocomplete="billingZip">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 justify-content-center">
                    <p class="card-header clr-yellow">Szállítási információk</p>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="shippingName" class="col-4 col-form-label text-end">Vezetéknév & Keresztnév</label>
                            <div class="col-8">
                                <input id="shippingName" type="text" class="form-control @error('shippingName') is-invalid @enderror"
                                    name="shippingName" value="{{ old('shippingName') }}" required autocomplete="shippingName">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phoneNumber" class="col-4 col-form-label text-end">Telefonszám</label>
                            <div class="col input-group">
                                <div class="input-group-text">+</div>
                                <input id="phoneNumber" type="number" class="form-control @error('phoneNumber') is-invalid @enderror"
                                    name="phoneNumber" value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber">
                            </div>
                        </div>
                        <div class="row mb-3 form-check">
                            <div class="col-8 offset-4">
                                <input class="form-check-input" type="checkbox" value="" name="shippingMatches" id="shippingMatches">
                                <label class="form-check-label" for="shippingMatches">
                                    Megegyezik a számlázási információkkal
                                </label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="shippingCity" class="col-4 col-form-label text-end">Város/település</label>
                            <div class="col-6">
                                <input id="shippingCity" type="text" class="form-control @error('shippingCity') is-invalid @enderror"
                                    name="shippingCity" value="{{ old('shippingCity') }}" autocomplete="shippingCity">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="shippingStreet" class="col-4 col-form-label text-end">Út/utca</label>
                            <div class="col-4">
                                <input id="shippingStreet" type="text" class="form-control @error('shippingStreet') is-invalid @enderror"
                                    name="shippingStreet" value="{{ old('shippingStreet') }}" autocomplete="shippingStreet">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="shippingStreetNum" class="col-4 col-form-label text-end">Házszám</label>
                            <div class="col-2">
                                <input id="shippingStreetNum" type="number" class="form-control @error('shippingStreetNum') is-invalid @enderror"
                                    name="shippingStreetNum" value="{{ old('shippingStreetNum') }}" autocomplete="shippingStreetNum">
                            </div>
                            <label for="shippingZip" class="col-2 col-form-label text-end">Irányítószám</label>
                            <div class="col-2">
                                <input id="shippingZip" type="number" class="form-control @error('shippingZip') is-invalid @enderror"
                                    name="shippingZip" value="{{ old('shippingZip') }}" required autocomplete="shippingZip">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mb-5 p-2">
                    <button type="submit" class="ts-3 font-large col-4 btn btn-orange clr-black mx-auto">
                        Regisztrálás
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
