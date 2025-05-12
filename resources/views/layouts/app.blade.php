<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bigyónomicon') }}</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Metamorphous" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>

    <script src="https://cdn.babylonjs.com/babylon.js"></script>
    <script src="https://cdn.babylonjs.com/loaders/babylonjs.loaders.min.js"></script>
    <script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('js/connectivity.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js', 'resources/js/index.js', 'resources/js/babylon.js'])
</head>
<body>
    <div id="app" data-bs-theme="dark">
        <nav class="navbar bg-navbargray sticky-top m-0 g-0" data-bs-theme="dark">
            <div class="container flex flex-row">
                <img src="{{ asset('img/logo.png') }}" class="navbarLogo inline-block left-0 top-0 d-none d-xl-block">
                <div class="col-lg-4 align-items-center h-100 z-2 d-none d-lg-block">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('img/title.png') }}" alt="Bigyónomicon" class="navbarTitle inline-block w-75 my-auto">
                    </a>
                </div>
                <div class="col-12 col-lg-8 z-3">
                    <div class="flex flex-row h-100 gap-4 justify-content-end">
                        <a class="fs-4 nav-link clr-light my-auto" href="{{ route('home' )}}">Főoldal</a>
                        <a class="fs-4 nav-link clr-light my-auto" href="{{ route('store') }}">Áruház</a>
                        <a class="fs-4 nav-link clr-light my-auto" href="{{ route('contact') }}">Kapcsolat</a>
                        <div class="dropdown my-auto">
                            <button class="btn my-auto btn-gray clr-light dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-cart fs-5 clr-light"></i></button>
                            <ul class="dropdown-menu cartDropdown">
                                <li><a class="dropdown-item clr-yellow" href="{{ route('cart') }}">A Kosárhoz</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <div class="flex flex-col w-100">
                                    @auth
                                        @php
                                            $cartItems = \App\Models\CartItem::where('user_id', Auth::id())
                                                ->with('product')
                                                ->take(3)
                                                ->get();
                                            $cartCount = \App\Models\CartItem::where('user_id', Auth::id())->count();
                                        @endphp

                                        @if($cartItems->count() > 0)
                                            @foreach($cartItems as $item)
                                            <div class="card m-auto mb-2">
                                                <div class="row g-0">
                                                    <div class="col-3 h-100">
                                                        <img src="{{ asset('productImg/bigyo'.$item->product->id.'.png') }}" class="img-fluid img-cover">
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="card-body">
                                                            <h5 class="card-title fs-5 clr-yellow font-large"><b><a class="nav-link" href="{{ route('product'.$item->product->id) }}">{{ $item->product->name }}</a></b></h5>
                                                            <div class="row g-1">
                                                                <div class="col-4">
                                                                    <a href="{{ route('product'.$item->product->id) }}">
                                                                        <button type="button" class="btn btn-yellow w-full">
                                                                            <i class="bi bi-search clr-black"></i>
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                                <div class="col-4">
                                                                    <a href="{{ route('cart.remove', $item->id) }}" onclick="event.preventDefault(); document.getElementById('remove-cart-item-{{ $item->id }}').submit();">
                                                                        <button type="button" class="btn btn-red w-full">
                                                                            <i class="bi bi-trash-fill clr-black"></i>
                                                                        </button>
                                                                    </a>
                                                                    <form id="remove-cart-item-{{ $item->id }}" action="{{ route('cart.remove', $item->id) }}" method="POST" style="display: none;">
                                                                        @csrf
                                                                    </form>
                                                                </div>
                                                                <div class="col-4">
                                                                    <p class="clr-light text-end mt-auto">{{ $item->quantity }} Db</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            @if($cartCount > 3)
                                                <div class="text-center mb-2">
                                                    <small class="clr-light">...és még {{ $cartCount - 3 }} termék</small>
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-center p-3">
                                                <p class="clr-light">A kosár üres</p>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center p-3">
                                            <p class="clr-light">Jelentkezz be a kosár használatához!</p>
                                        </div>
                                    @endauth
                                </div>
                            </ul>
                        </div>
                        @guest
                            <!-- Guest users see login button -->
                            <button class="btn my-auto btn-yellow clr-dark">
                                <a href="{{ route('login') }}" class="fs-5 nav-link">Bejelentkezés</a>
                            </button>
                        @else
                            <!-- Authenticated users see account dropdown -->
                            <div class="dropdown my-auto">
                                <button class="fs-5 btn my-auto btn-gray clr-light dropdown-toggle" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('account') }}">
                                            <i class="bi bi-gear-fill clr-white mr-2"></i>Fiók
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right clr-white mr-2"></i>Kijelentkezés
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
        <div class="row justify-content-center g-0">
            <div class="col-12 col-md-11 col-lg-10 mx-auto h-full">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
        <footer class="row fixed-bottom bg-navbargray g-0 mt-5 py-1 px-5">
            <div class="col-12 col-lg-5 flex flex-row gap-4 h-full z-2">
                <a href="#" class="my-auto"><i class="bi bi-arrow-up-square-fill clr-yellow fs-3"></i></a>
                <a href="{{ route('home' )}}" class="my-auto"><span class="nav-link clr-light">Főlap</span></a>
                <a href="{{ route('store' )}}" class="my-auto"><span class="nav-link clr-light">Áruház</span></a>
                <a href="{{ route('contact' )}}" class="my-auto"><span class="nav-link clr-light">Kapcsolat</span></a>
                <a href="{{ route('cart' )}}" class="my-auto"><span class="nav-link clr-light">Kosár</span></a>
                <a href="#" class="my-auto" id="no-internet-text"><span class="nav-link clr-red">Internetmentes Zóna</span></a>
            </div>
            <div class="col-0 col-lg-7 text-end d-none d-lg-block h-full">
                <p class="clr-gray my-auto">© Copyright <b>Bigyonomicon Eurasia Zrt.</b> Minden jog fenntartva.</p>
            </div>
        </footer>
    </div>
    @yield('scripts')
</body>
</html>

