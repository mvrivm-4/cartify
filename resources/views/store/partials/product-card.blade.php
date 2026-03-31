<div class="card product-card h-100 border-0 shadow-sm">
    @if($product->resolved_image)
        <img src="{{ asset($product->resolved_image) }}" class="product-image" alt="{{ $product->name }}">
    @else
        <div class="product-image-placeholder d-flex align-items-center justify-content-center">
            <span class="text-muted small">Image Placeholder</span>
        </div>
    @endif
    <div class="card-body d-flex flex-column">
        <span class="badge bg-light text-dark mb-2 align-self-start">{{ $product->category->name ?? 'General' }}</span>
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text text-muted small flex-grow-1">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <strong class="text-primary">${{ number_format($product->price, 2) }}</strong>
            <div class="d-flex gap-2">
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-dark">View</a>
                @auth
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="js-add-to-cart-form">
                        @csrf
                        <button class="btn btn-sm btn-primary">Add to Cart</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Add to Cart</a>
                @endauth
            </div>
        </div>
    </div>
</div>
