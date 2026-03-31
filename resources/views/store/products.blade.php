@extends('layouts.app')

@section('title', 'Products | Cartify')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="h2 mb-4">Products</h1>

        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-6">
                <input type="text" class="form-control" name="q" value="{{ $search }}" placeholder="Search by product name...">
            </div>
            <div class="col-md-4">
                <select class="form-select" name="category">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected($selectedCategory == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    @include('store.partials.product-card', ['product' => $product])
                </div>
            @empty
                <p class="text-muted">No products found.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
