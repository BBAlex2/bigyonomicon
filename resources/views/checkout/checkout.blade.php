@extends('layouts.app')

@section('content')
<div class="container bg-dark row justify-content-center py-4">
    <div class="col-12">
        <p class="fs-2 clr-yellow"><i class="bi bi-credit-card me-2"></i>Fizetési adatok</p>
    </div>

    <div class="col-md-8 col-lg-6">
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body">
                <form id="payment-form">
                    <!-- Billing Information -->
                    <div class="mb-4">
                        <h4 class="clr-orange mb-3">Számlázási adatok</h4>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="billing-name" class="form-label clr-light">Teljes név</label>
                                <input type="text" class="form-control" id="billing-name" placeholder="Kovács János">
                            </div>
                            <div class="col-md-6">
                                <label for="billing-email" class="form-label clr-light">Email cím</label>
                                <input type="email" class="form-control" id="billing-email" placeholder="pelda@email.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="billing-address" class="form-label clr-light">Cím</label>
                                <input type="text" class="form-control" id="billing-address" placeholder="Példa utca 123">
                            </div>
                            <div class="col-md-6">
                                <label for="billing-city" class="form-label clr-light">Város</label>
                                <input type="text" class="form-control" id="billing-city" placeholder="Budapest">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="billing-zip" class="form-label clr-light">Irányítószám</label>
                                <input type="text" class="form-control" id="billing-zip" placeholder="1234">
                            </div>
                            <div class="col-md-8">
                                <label for="billing-phone" class="form-label clr-light">Telefonszám</label>
                                <input type="tel" class="form-control" id="billing-phone" placeholder="+36 30 123 4567">
                            </div>
                        </div>
                    </div>

                    <!-- Credit Card Information -->
                    <div class="mb-4">
                        <h4 class="clr-orange mb-3">Bankkártya adatok</h4>

                        <div class="mb-3">
                            <label for="card-number" class="form-label clr-light">Kártyaszám</label>
                            <input type="text" class="form-control" id="card-number" placeholder="1234 5678 9012 3456">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="card-name" class="form-label clr-light">Kártyán szereplő név</label>
                                <input type="text" class="form-control" id="card-name" placeholder="KOVACS JANOS">
                            </div>
                            <div class="col-md-3">
                                <label for="card-expiry" class="form-label clr-light">Lejárati dátum</label>
                                <input type="text" class="form-control" id="card-expiry" placeholder="MM/ÉÉ">
                            </div>
                            <div class="col-md-3">
                                <label for="card-cvc" class="form-label clr-light">CVC/CVV</label>
                                <input type="text" class="form-control" id="card-cvc" placeholder="123">
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="mb-4">
                        <h4 class="clr-orange mb-3">Rendelés összegzése</h4>

                        @php
                            $cartItems = Auth::check() ? \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get() : collect();
                            $subtotal = 0;
                            foreach($cartItems as $item) {
                                $subtotal += $item->product->price * $item->quantity;
                            }
                            $shipping = 1990;
                            $total = $subtotal + $shipping;
                        @endphp

                        <div class="card bg-dark border-secondary mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="clr-light">Termékek összesen:</span>
                                    <span class="clr-light">{{ number_format($subtotal, 0, '.', ' ') }} Ft</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="clr-light">Szállítási díj:</span>
                                    <span class="clr-light">{{ number_format($shipping, 0, '.', ' ') }} Ft</span>
                                </div>
                                <hr class="border-secondary">
                                <div class="d-flex justify-content-between">
                                    <span class="clr-yellow fw-bold">Fizetendő összesen:</span>
                                    <span class="clr-yellow fw-bold">{{ number_format($total, 0, '.', ' ') }} Ft</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="d-grid">
                        <button type="button" id="payment-button" class="btn btn-green clr-light btn-lg">
                            <i class="bi bi-lock-fill me-2"></i>Fizetés
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Success Message (hidden by default) -->
    <div class="col-md-8 col-lg-6">
        <div id="payment-success" class="card bg-dark border-success d-none">
            <div class="card-body">
                <h4 class="clr-green"><i class="bi bi-check-circle-fill me-2"></i>Sikeres fizetés!</h4>
                <p class="clr-light">A fizetés sikeres volt. A megrendelés összefoglalóját tartalmazó visszaigazoló e-mailt elküldtük az email-címére.</p>
                <hr class="border-secondary">
                <p class="mb-0">
                    <a href="{{ route('store') }}" class="btn btn-yellow clr-black">
                        <i class="bi bi-arrow-left me-2"></i>Vissza a boltba
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentForm = document.getElementById('payment-form');
        const paymentButton = document.getElementById('payment-button');
        const paymentSuccess = document.getElementById('payment-success');

        paymentButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Hide the form and show success message
            paymentForm.parentElement.parentElement.classList.add('d-none');
            paymentSuccess.classList.remove('d-none');

            // Scroll to success message
            paymentSuccess.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
@endsection
