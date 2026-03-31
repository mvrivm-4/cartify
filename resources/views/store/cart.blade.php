@extends('layouts.app')

@section('title', 'Cart | Cartify')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="h2 mb-4">Shopping Cart</h1>
        @if(empty($cartItems))
            <div class="alert alert-info">Your cart is empty.</div>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <form class="d-flex" action="{{ route('cart.update', $item->product_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input class="form-control me-2" style="max-width:90px" type="number" name="quantity" min="1" value="{{ $item->quantity }}">
                                    <button class="btn btn-outline-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h4 class="mb-0">Grand Total: <span class="text-primary">${{ number_format($total, 2) }}</span></h4>
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">Proceed to Checkout</a>
            </div>
        @endif
    </div>
</section>
@endsection
