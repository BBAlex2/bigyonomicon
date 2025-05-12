<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'reviewText' => 'required|string|max:500',
            'reviewRating' => 'required|integer|min:0|max:10',
        ]);

        // Check if product exists
        $product = Product::findOrFail($productId);

        // Create the comment
        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'content' => $request->reviewText,
            'rating' => $request->reviewRating,
        ]);

        // Update product rating
        $this->updateProductRating($productId);

        return redirect()->back()->with('success', 'Vélemény sikeresen hozzáadva!');
    }

    /**
     * Update the product's average rating.
     */
    private function updateProductRating($productId)
    {
        $product = Product::findOrFail($productId);

        $comments = Comment::where('product_id', $productId)->get();
        $ratingCount = $comments->count();

        if ($ratingCount > 0) {
            $ratingSum = $comments->sum('rating');
            $averageRating = $ratingSum / $ratingCount;

            $product->rating = $averageRating;
            $product->rating_count = $ratingCount;
            $product->save();
        }
    }
}
