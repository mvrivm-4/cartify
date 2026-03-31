<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function home(): View
    {
        return view('store.home', [
            'featuredProducts' => Product::with('category')->latest()->take(8)->get(),
            'categories' => Category::withCount('products')->latest()->get(),
        ]);
    }

    public function index(Request $request): View
    {
        $query = Product::with('category')->latest();

        if ($request->filled('category')) {
            $query->where('category_id', (int) $request->input('category'));
        }

        if ($request->filled('q')) {
            $search = (string) $request->input('q');
            $query->where(function ($subQuery) use ($search): void {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return view('store.products', [
            'products' => $query->paginate(12)->withQueryString(),
            'categories' => Category::latest()->get(),
            'selectedCategory' => (string) $request->input('category', ''),
            'search' => (string) $request->input('q', ''),
        ]);
    }

    public function show(Product $product): View
    {
        return view('store.product-details', [
            'product' => $product->load('category'),
            'relatedProducts' => Product::where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->latest()
                ->take(4)
                ->get(),
        ]);
    }
}
