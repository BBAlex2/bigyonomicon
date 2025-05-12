@extends('layouts.app')

@section('content')
<div class="w-100 row justify-content-center">
    <div class="col-4 col-md-3 bg-dark py-2">
        <p class="fs-4 clr-yellow w-100">Szűrés</p>
        <form method="POST" action="{{ route('store.filter') }}">
            @csrf
            <div class="flex flex-col">
                <div class="mb-4">
                    <label for="filterName" class="form-label clr-orange">Név</label>
                    <div class="input-group">
                        <div class="input-group-text"><i class="bi bi-search clr-light h-100"></i></div>
                        <input id="filterName" type="text" class="form-control" name="filterName"
                            value="{{ request('filterName', old('filterName')) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="filterRating" class="form-label clr-orange">Értékelés</label>
                    <input type="range" class="form-range" name="filterRating" id="filterRating"
                        value="{{ request('filterRating', old('filterRating', 1)) }}" min="1" max="10" oninput="updateRatingValue(this.value)">
                    <span class="fs-6 clr-gray" id="filterRatingLabel">{{ request('filterRating', old('filterRating', 1)) }}</span>
                </div>
                <div class="mb-3">
                    <label for="filterPrice" class="form-label clr-orange">Ár</label>
                    <input type="range" class="form-range" name="filterPrice" id="filterPrice"
                        value="{{ request('filterPrice', old('filterPrice', 99)) }}" min="1" max="99" oninput="updatePriceValue(this.value)">
                    <span class="fs-6 clr-gray" id="filterPriceLabel">{{ number_format(request('filterPrice', old('filterPrice', 99)) * 10000, 0, '.', ' ') }} Ft</span>
                </div>
                <button type="submit" class="btn btn-gray clr-light mx-auto" style="width: fit-content;">Szűrés</button>
            </div>
        </form>
    </div>
    <div class="col-7 col-md-8 offset-md-1 bg-dark py-2">
        <div class="flex flex-col">
            @if($products->count() > 0)
                @foreach($products as $product)
                <div class="card storeCard mb-3">
                    <div class="row g-0 h-100">
                        <div class="col-3">
                            <a href="{{ route('product'.$product->id) }}">
                                <img src="{{ asset('productImg/bigyo'.$product->id.'.png') }}" class="rounded-start w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="col-9">
                            <div class="card-body flex flex-col h-100">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5 class="fs-3 clr-yellow font-large"><b><a class="nav-link" href="{{ route('product'.$product->id) }}">{{ $product->name }}</a></b></h5>
                                        </div>
                                        <div class="col-3 text-end d-none d-lg-block">
                                            <i class="bi bi-star-fill clr-yellow ml-1 h-100 fs-5">{{ number_format($product->rating, 1) }}</i>
                                        </div>
                                    </div>
                                    <p class="card-subtitle fs-5 clr-orange my-auto">{{ number_format($product->price, 0, '.', ' ') }} Ft</p>
                                    <div class="flex flex-row mt-3 gap-2">
                                        @if($product->category)
                                            <span class="badge bg-gray clr-black font-large fs-6">{{ $product->category->name }}</span>
                                        @endif
                                        @if($product->subcategory)
                                            <span class="badge bg-light clr-black font-large fs-6">{{ $product->subcategory->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <div class="row g-2">
                                        <div class="col-6 col-lg-5 col-xl-3">
                                            <a href="{{ route('product'.$product->id) }}">
                                                <button type="button" class="btn btn-yellow clr-black w-100">
                                                    <span class="bi bi-search clr-black d-xl-none"></span>
                                                    <span class="d-none d-xl-block clr-black">Megtekintés</span>
                                                </button>
                                            </a>
                                        </div>
                                        @auth
                                        <form method="POST" action="{{ route('cart.add', $product->id) }}" class="d-flex flex-row">
                                            @csrf
                                            <div class="col-6 col-lg-3 col-xl-3 me-2">
                                                <button type="submit" class="btn btn-gray clr-light w-100">
                                                    <span class="bi bi-cart-plus-fill clr-light d-xl-none"></span>
                                                    <span class="d-none d-xl-block">Kosárba</span>
                                                </button>
                                            </div>
                                            <div class="col-12 col-lg-4 col-xl-3">
                                                <div class="input-group">
                                                    <div class="input-group-text">Db</div>
                                                    <input type="number" class="form-control" name="amount" value="1">
                                                </div>
                                            </div>
                                        </form>
                                        @else
                                        <div class="col-6 col-lg-7 col-xl-6">
                                            <a href="{{ route('login') }}" class="btn btn-gray clr-light w-100">
                                                <span class="bi bi-person-fill clr-light d-xl-none"></span>
                                                <span class="d-none d-xl-block">Bejelentkezés a vásárláshoz</span>
                                            </a>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-info">Nincs találat a keresési feltételeknek megfelelően.</div>
            @endif

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    {{ $products->links('pagination::bootstrap-4') }}
                </ul>
            </nav>

            <!-- üres hely, hogy a Copyright rész ne takarja el a lap alját -->
            <div class="pb-5 mb-5"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateRatingValue(val) {
        document.getElementById('filterRatingLabel').textContent = val;
    }

    function updatePriceValue(val) {
        const price = val * 10000;
        document.getElementById('filterPriceLabel').textContent = price.toLocaleString('hu-HU') + ' Ft';
    }

    // Initialize values on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRatingValue(document.getElementById('filterRating').value);
        updatePriceValue(document.getElementById('filterPrice').value);
    });
</script>
@endsection
