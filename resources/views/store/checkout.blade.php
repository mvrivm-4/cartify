@extends('layouts.app')

@section('title', 'Checkout | Cartify')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="h2 mb-4">Checkout</h1>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <p class="text-muted">This is a demo checkout. No real payment is processed.</p>
                            <button class="btn btn-primary btn-lg">Place Fake Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5>Order Summary</h5>
                        <ul class="list-group list-group-flush mb-3">
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                                    <span>${{ number_format($item->quantity * $item->product->price, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <h5>Total: <span class="text-primary">${{ number_format($total, 2) }}</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
