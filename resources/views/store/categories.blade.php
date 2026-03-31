@extends('layouts.app')

@section('title', 'Categories | Cartify')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="h2 mb-4">All Categories</h1>
        <div class="row g-3">
            @foreach($categories as $category)
                <div class="col-md-4 col-lg-3">
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
