@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-2">
    <div class="row g-0">
        <div class="card col-6 mx-auto">
            <h5 class="card-header flex flex-row clr-yellow">
                <i class="bi bi-person-circle fs-5 mr-2 clr-yellow"></i>
                Fiók
            </h5>
            <div class="card-body">
                <form action="" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-6">
                        <label for="username" class="form-label">Felhasználónév</label>
                        <input type="text" class="form-control" id="username" name="username" value="">
                    </div>
                    <div class="col-6">
                        <label for="password" class="form-label">Jelszó</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="">
                    </div>
                    <p class="fs-5 clr-yellow mt-3">Szállítási cím</p>
                    <div class="row mx-auto">
                        <div class="col-12 mb-2">
                            <label for="shippingName" class="form-label">Vezetéknév & Keresztnév</label>
                            <input type="text" class="form-control" id="shippingName" name="shippingName" value="">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="city" class="form-label">Telefonszám</label>
                            <div class="col input-group">
                                <div class="input-group-text">+</div>
                                <input id="phoneNumber" type="number" class="form-control @error('phoneNumber') is-invalid @enderror"
                                    name="phoneNumber" autocomplete="phoneNumber" value="">
                            </div>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="shippingZip" class="form-label">Irányítószám</label>
                            <input type="text" class="form-control" id="shippingZip" name="shippingZip" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="shippingStreet" class="form-label">Város/település</label>
                            <input type="text" class="form-control" id="shippingStreet" name="shippingStreet" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="shippingStreet" class="form-label">Út/utca</label>
                            <input type="text" class="form-control" id="shippingStreet" name="shippingStreet" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="shippingStreetNum" class="form-label">Házszám</label>
                            <input type="text" class="form-control" id="shippingStreetNum" name="shippingStreetNum" value="">
                        </div>
                    </div>
                    <p class="fs-5 clr-orange mt-3">Számlázási cím</p>
                    <div class="row mx-auto">
                        <div class="col-12 mb-2">
                            <label for="billingName" class="form-label">Cég (név)</label>
                            <input type="text" class="form-control" id="billingName" name="billingName" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="shippingZip" class="form-label">Irányítószám</label>
                            <input type="text" class="form-control" id="shippingZip" name="shippingZip" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="billingCity" class="form-label">Város/település</label>
                            <input type="text" class="form-control" id="billingCity" name="billingCity" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="billingStreet" class="form-label">Út/utca</label>
                            <input type="text" class="form-control" id="billingStreet" name="billingStreet" value="">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="billingStreetNum" class="form-label">Házszám</label>
                            <input type="text" class="form-control" id="billingStreetNum" name="billingStreetNum" value="">
                        </div>
                    </div>
                    <div class="col-4 mx-auto">
                        <button type="submit" class="btn btn-yellow clr-black font-large w-full mx-auto">
                            <i class="bi bi-floppy-fill fs-6 mr-2 clr-black"></i>
                            Adatok frissítése
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection