<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $user = auth()->user();

        // Check if the product is already in the user's cart
        $existingCartItem = $user->cart()->where('product_id', $product->id)->first();

        if (!$existingCartItem) {
            // If it doesn't exist, create a new cart item
            $user->cart()->attach($product->id);
            return back()->with('success', 'Product added to cart.');
        }

        return back()->with('error', 'Product is already in the cart.');
    }




    public function remove(Product $product)
    {
        $user = auth()->user();
        $cartItems = $user->cart();

        if ($cartItems->where('product_id', $product->id)->exists()) {
            $cartItems->detach($product->id);
            return back()->with('success', 'Product removed from cart.');
        }

        return back()->with('error', 'Product is not in the cart.');
    }


    public function removeCartItem($cartItemId)
    {
        auth()->user()->cart()->detach($cartItemId);
        return back()->with('success', 'Product removed from cart.');
    }

    public function show()
    {
        $cartItems = auth()->user()->cart;

        // Shared page configs between show and index methods
        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],
            ['link' => "javascript:void(0)", 'name' => "eCommerce"],
            ['name' => "Cart"]
        ];

        return view('content.apps.ecommerce.app-ecommerce-checkout', compact('cartItems', 'pageConfigs', 'breadcrumbs'));
    }
}
