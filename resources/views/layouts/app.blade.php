<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cartify')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container py-2">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">Cart<span class="text-primary">ify</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <form class="d-flex mx-lg-4 my-3 my-lg-0 flex-grow-1" method="GET" action="{{ route('products.index') }}">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search products...">
                    <button class="btn btn-primary px-3" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                    @auth
                        <li class="nav-item">
                            <a class="btn btn-outline-dark position-relative js-cart-link" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart3 me-1"></i>Cart
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <span class="js-cart-count">{{ App\Models\Cart::where('user_id', auth()->id())->sum('quantity') ?? 0 }}</span>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-secondary">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-dark position-relative" href="{{ route('login') }}">
                                <i class="bi bi-cart3 me-1"></i>Cart
                            </a>
                        </li>
                        <li class="nav-item"><a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-sm btn-primary" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="pb-5">
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif
        @if(session('toast_success'))
            <!-- Toast notification -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
                <div id="liveToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('toast_success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    const toastEl = document.getElementById('liveToast');
                    if(toastEl) {
                        toastEl.classList.remove('show');
                    }
                }, 3000);
            </script>
        @endif
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-3">
            <span>© {{ date('Y') }} Cartify. All rights reserved.</span>
            <span>Built with Laravel + Bootstrap</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</body>
</html>
