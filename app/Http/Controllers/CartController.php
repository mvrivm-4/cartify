<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return view('store.cart', [
            'cartItems' => $cartItems,
            'total' => $cartItems->sum(fn (Cart $item): float => $item->quantity * (float) $item->product->price),
        ]);
    }

    public function add(Request $request, Product $product): RedirectResponse|JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $cart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $cartCount = (int) Cart::where('user_id', $user->id)->sum('quantity');
        
        if ($request->expectsJson()) {
            return response()->json([
                'message' => "{$product->name} added to cart.",
                'cart_count' => $cartCount,
            ]);
        }

        // Add a simple toast session variable
        return back()->with('toast_success', "{$product->name} added to cart.");
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        Cart::where('user_id', $user->id)->where('product_id', $product->id)->delete();

        return back()->with('success', 'Item removed.');
    }
}
