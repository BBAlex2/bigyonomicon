@extends('layouts.app')

@section('content')
<div class="col-12 bg-dark p-2 py-4 mx-auto justify-content-center">
    <div class="row">
        <div class="col-5">
            <canvas class="bg-black w-full my-auto" id="babylonCanvas" data-productid="{{ $product->id }}" touch-action="none">
                <i class="bi bi-arrow-repeat fs-3 clr-light canvasIcon"></i>
            </canvas>
        </div>
        <div class="col-7 flex flex-col">
            <div class="flex flex-col">
                <p class="fs-1 clr-yellow font-large my-0">{{ $product->name }}</p>
                <div class="flex flex-row my-0">
                    @php
                        $fullStars = floor($product->rating);
                        $emptyStars = 10 - $fullStars;
                    @endphp
                    @for ($count = 0; $count < $fullStars; $count++)
                        <i class="bi bi-star-fill clr-yellow fs-4"></i>
                    @endfor
                    @for ($count = 0; $count < $emptyStars; $count++)
                        <i class="bi bi-star clr-yellow fs-4"></i>
                    @endfor
                    <span class="fs-4 clr-light ml-2">{{ number_format($product->rating, 1) }}</span>
                </div>
                <p class="card-subtitle fs-4 clr-orange mt-0">{{ number_format($product->price, 0, '.', ' ') }} Ft</p>
                <div class="flex flex-row mt-3 gap-2">
                    @if($product->category)
                        <span class="badge bg-gray clr-black font-large fs-6">{{ $product->category->name }}</span>
                    @endif
                    @if($product->subcategory)
                        <span class="badge bg-light clr-black font-large fs-6">{{ $product->subcategory->name }}</span>
                    @endif
                </div>
            </div>
            @auth
            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-auto">
                @csrf
                <div class="row">
                    <div class="col-3 col-lg-3 col-xl-3">
                        <button type="submit" class="btn btn-green clr-light w-100">
                            <span class="bi bi-cart-plus-fill clr-light d-xl-none"></span>
                            <span class="d-none d-xl-block">Kosárba</span>
                        </button>
                    </div>
                    <div class="col-4 col-lg-4 col-xl-3">
                        <div class="input-group">
                            <div class="input-group-text">Db</div>
                            <input type="number" class="form-control" name="amount" value="1">
                        </div>
                    </div>
                </div>
            </form>
            @else
            <div class="mt-auto">
                <div class="row">
                    <div class="col-7 col-lg-7 col-xl-6">
                        <a href="{{ route('login') }}" class="btn btn-yellow clr-black w-100">
                            <span class="d-none d-xl-block">Bejelentkezés a vásárláshoz</span>
                            <span class="d-xl-none">Bejelentkezés</span>
                        </a>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
    <div id="productButtonDiv" class="btn-group p-4 py-4 w-100 justify-content-center" role="group">
        <button id="descriptionButton" type="button" class="btn btn-yellow clr-black">Leírás</button>
        <button id="parameterButton" type="button" class="btn btn-gray clr-light">Paraméterek</button>
        <button id="reviewButton" type="button" class="btn btn-gray clr-light">Vélemények</button>
    </div>
    <div id="descriptionFrame" class="px-4" style="">
        <p class="fs-5 clr-light">
            {{ $product->description }}
        </p>
    </div>
    <div id="parameterFrame" class="px-4 fs-4 row" style="display: none">
        <div class="col-6 flex flex-col g-2">
            <div>
                <i class="bi bi-rulers clr-yellow mr-2"></i><span class="clr-yellow">Méret</span>
                <p class="clr-light">30cm x 15cm (M x Átm)</p>
            </div>
            <div>
                <i class="bi bi-box-fill clr-yellow mr-2"></i><span class="clr-yellow">Súly</span>
                <p class="clr-light">1.2 Kg</p>
            </div>
            <div>
                <i class="bi bi-palette-fill clr-yellow mr-2"></i><span class="clr-yellow">Szín</span>
                <p class="clr-light">Pasztelzöld</p>
            </div>
        </div>
        <div class="col-6 flex flex-col g-2">
            <div>
                <i class="bi bi-tree-fill clr-yellow mr-2"></i><span class="clr-yellow">Anyag</span>
                <p class="clr-light">Kerámia</p>
            </div>
            <div>
                <i class="bi bi-archive-fill clr-yellow mr-2"></i><span class="clr-yellow">Raktáron</span>
                <p class="clr-light">3 db</p>
            </div>
            <div>
                <i class="bi bi-shield-check clr-yellow mr-2"></i><span class="clr-yellow">Állapot</span>
                <p class="clr-light">Kiváló, apró kopásnyomokkal</p>
            </div>
        </div>
    </div>
    <div id="reviewFrame" class="p-2 flex flex-col" style="display: none">
        <div class="row g-2">
            <div class="col-5">
                @auth
                <form method="POST" action="{{ route('comment.store', $product->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="reviewRating" class="form-label clr-orange">Értékelés</label>
                        <input type="range" class="form-range" name="reviewRating" id="reviewRating" min="1" max="10" value="8" oninput="updateRatingValue(this.value)">
                        <span class="fs-6 clr-gray" id="reviewRatingLabel">8</span>
                    </div>
                    <div class="mb-3">
                        <label for="reviewText" class="form-label clr-orange">Vélemény</label>
                        <textarea class="form-control" id="reviewText" name="reviewText" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-yellow clr-black">Küldés</button>
                </form>
                @else
                <div class="alert alert-info">
                    <p>Vélemény írásához kérjük, jelentkezzen be!</p>
                    <div class="mt-2">
                        <a href="{{ route('login') }}" class="btn btn-yellow clr-black">Bejelentkezés</a>
                        <a href="{{ route('register') }}" class="btn btn-gray clr-light ml-2">Regisztráció</a>
                    </div>
                </div>
                @endauth
            </div>
            <div class="col-7">
                @if($product->comments->count() > 0)
                    @foreach($product->comments as $comment)
                    <div class="card p-2 mb-2">
                        <p class="card-title fs-5 clr-orange font-large">{{ $comment->user->name }}</p>
                        <div class="flex flex-row mt-0 mb-2">
                            @php
                                $fullStars = floor($comment->rating);
                                $emptyStars = 10 - $fullStars;
                            @endphp
                            @for($count = 0; $count < $fullStars; $count++)
                                <i class="bi bi-star-fill clr-yellow fs-5"></i>
                            @endfor
                            @for($count = 0; $count < $emptyStars; $count++)
                                <i class="bi bi-star clr-yellow fs-5"></i>
                            @endfor
                        </div>
                        <p class="card-text clr-light">{{ $comment->content }}</p>
                    </div>
                    @endforeach
                @else
                    <div class="alert alert-info">Még nincsenek vélemények ehhez a termékhez.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add empty space to prevent footer overlap -->
    <div class="pb-5 mb-5"></div>
</div>
@endsection

@section('scripts')
<script>
    function updateRatingValue(val) {
        document.getElementById('reviewRatingLabel').textContent = val;
    }

    // Initialize values on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRatingValue(document.getElementById('reviewRating').value);
    });
</script>
@endsection


