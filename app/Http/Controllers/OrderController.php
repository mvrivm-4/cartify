<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function checkout(): View|RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id])->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        $total = $cart->items->sum(fn ($item): float => $item->quantity * (float) $item->product->price);

        return view('store.checkout', [
            'cartItems' => $cart->items,
            'total' => $total,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id])->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Your cart is empty.');
        }

        DB::transaction(function () use ($user, $cart): void {
            $total = $cart->items->sum(fn ($item): float => $item->quantity * (float) $item->product->price);

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            $cart->items()->delete();
        });

        return redirect()->route('home')->with('success', 'Order placed successfully.');
    }
}
