<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the user's cart.
     */
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('checkout.cart', compact('cartItems'));
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        // Check if product exists
        $product = Product::findOrFail($productId);

        // Check if the product is already in the cart
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update quantity if already in cart
            $cartItem->quantity += $request->amount;
            $cartItem->save();
        } else {
            // Add new item to cart
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->amount,
            ]);
        }

        return redirect()->back()->with('success', 'Termék sikeresen hozzáadva a kosárhoz!');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function updateCartItem(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->quantity = $request->amount;
        $cartItem->save();

        return redirect()->route('cart')->with('success', 'Kosár sikeresen frissítve!');
    }

    /**
     * Remove a cart item.
     */
    public function removeCartItem($id)
    {
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart')->with('success', 'Termék sikeresen eltávolítva a kosárból!');
    }
}
