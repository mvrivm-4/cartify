@extends('layouts.app')

@section('title', $product->name . ' | Cartify')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                @if($product->resolved_image)
                    <img src="{{ asset($product->resolved_image) }}" alt="{{ $product->name }}" class="product-image-large rounded-4">
                @else
                    <div class="product-image-placeholder large d-flex align-items-center justify-content-center rounded-4">
                        <span class="text-muted">Large Image Placeholder</span>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <span class="badge bg-light text-dark mb-2">{{ $product->category->name }}</span>
                <h1 class="h2">{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->description }}</p>
                <h2 class="h3 text-primary mb-4">${{ number_format($product->price, 2) }}</h2>
                @auth
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="js-add-to-cart-form">
                        @csrf
                        <button class="btn btn-primary btn-lg">Add to Cart</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Add to Cart</a>
                @endauth
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <h3 class="h4 mb-3">Related Products</h3>
        <div class="row g-4">
            @foreach($relatedProducts as $item)
                <div class="col-md-3">
                    @include('store.partials.product-card', ['product' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
