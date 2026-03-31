<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::withCount('products')->latest()->get();

        return view('store.categories', [
            'categories' => $categories,
            'search' => (string) $request->input('q', ''),
        ]);
    }
}
