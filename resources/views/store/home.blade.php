@extends('layouts.app')

@section('title', 'Home | Cartify')

@section('content')
<section class="hero-section py-5">
    <div class="container">
        <div class="p-5 rounded-4 hero-banner text-white" data-aos="fade-up">
            <h1 class="display-5 fw-bold">Shop Smarter. Live Better.</h1>
            <p class="lead mb-4">Discover electronics, fashion, beauty, and more in one modern marketplace.</p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg">Start Shopping</a>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Featured Products</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-sm-6 col-lg-3" data-aos="zoom-in">
                    @include('store.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <h2 class="h3 mb-4">Shop by Category</h2>
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up">
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-decoration-none">
                        <div class="category-tile p-4 rounded-4 h-100">
                            <h3 class="h6 mb-2 text-dark">{{ $category->name }}</h3>
                            <p class="mb-0 text-muted">{{ $category->products_count }} products</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
