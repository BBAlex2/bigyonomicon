<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply filters if provided
        if ($request->filled('filterName')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filterName . '%')
                  ->orWhere('description', 'like', '%' . $request->filterName . '%');
            });
        }

        if ($request->filled('filterRating')) {
            $rating = $request->filterRating; // Rating is already 1-10
            $query->where('rating', '>=', $rating);
        }

        if ($request->filled('filterPrice')) {
            $price = $request->filterPrice * 10000; // Convert from 1-20 to 10000-200000
            $query->where('price', '<=', $price);
        }

        // Get products with pagination
        $products = $query->paginate(6);

        return view('main.store', compact('products'));
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with(['comments.user', 'category', 'subcategory'])->findOrFail($id);
        return view('main.product' . $id, compact('product'));
    }
}
