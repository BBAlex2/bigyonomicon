@extends('layouts.app')

@section('content')
<div class="container bg-dark justify-content-center py-2">
    <div class="row">
        <p class="fs-1 clr-yellow"><span class="bi bi-cart-fill fs-1 mr-2"></span>Kosár</p>
    </div>

    @auth
    <div class="row">
        <div class="col-8 flex flex-col">
            @if($cartItems->count() > 0)
                @foreach($cartItems as $cartItem)
                <div class="card storeCard mb-3">
                    <div class="row g-0 h-100">
                        <div class="col-3">
                            <a href="{{ route('product'.$cartItem->product->id) }}">
                                <img src="{{ asset('productImg/bigyo'.$cartItem->product->id.'.png') }}" class="rounded-start">
                            </a>
                        </div>
                        <div class="col-9">
                            <div class="card-body flex flex-col h-100">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="fs-3 clr-yellow font-large"><b><a class="nav-link" href="{{ route('product'.$cartItem->product->id) }}">{{ $cartItem->product->name }}</a></b></h5>
                                        </div>
                                    </div>
                                    <span class="card-subtitle fs-5 clr-orange my-auto">{{ number_format($cartItem->product->price, 0, '.', ' ') }} Ft</span>
                                </div>
                                <form method="POST" action="{{ route('cart.update', $cartItem->id) }}" class="mt-auto">
                                    @csrf
                                    <div class="row">
                                        <div class="col-5 col-lg-4 col-lg-2">
                                            <div class="input-group">
                                                <div class="input-group-text">Db</div>
                                                <input type="number" class="form-control" name="amount" value="{{ $cartItem->quantity }}">
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-3 col-xl-3">
                                            <a href="{{ route('cart.remove', $cartItem->id) }}" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $cartItem->id }}').submit();">
                                                <button type="button" class="btn btn-red clr-light w-100">
                                                    <span class="bi bi-trash clr-light d-xl-none"></span>
                                                    <span class="d-none d-xl-block">Törlés</span>
                                                </button>
                                            </a>
                                            <form id="remove-form-{{ $cartItem->id }}" action="{{ route('cart.remove', $cartItem->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                        <div class="col-3 col-lg-5 col-xl-3">
                                            <a href="{{ route('product'.$cartItem->product->id) }}">
                                                <button type="button" class="btn btn-yellow clr-black w-100">
                                                    <span class="bi bi-search clr-black d-xl-none"></span>
                                                    <span class="d-none d-xl-block">Megtekintés</span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-info">A kosár üres.</div>
            @endif
        </div>
        <div class="col-4 flex flex-col">
            @php
                $total = 0;
                foreach($cartItems as $item) {
                    $total += $item->product->price * $item->quantity;
                }
            @endphp
            <p class="fs-3 clr-gray">Összesen: <span class="clr-light">{{ number_format($total, 0, '.', ' ') }} Ft</span></p>
            <a href="{{ route('checkout') }}">
                <button class="btn btn-green clr-black w-100 mb-2">
                    <span class="bi bi-credit-card clr-light mr-2"></span>
                    <span class="clr-light">Tovább a fizetéshez</span>
                </button>
            </a>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning">
                <p class="fs-4 text-center">A kosár használatához kérjük, jelentkezzen be!</p>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="btn btn-yellow clr-black">Bejelentkezés</a>
                    <a href="{{ route('register') }}" class="btn btn-gray clr-light ml-2">Regisztráció</a>
                </div>
            </div>
        </div>
    </div>
    @endauth
</div>
@endsection
