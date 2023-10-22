<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function add(Product $product)
  {
    $user = auth()->user();

    $existingCartItem = $user->cart()->where('product_id', $product->id)->first();

    if (!$existingCartItem) {
      $user->cart()->attach($product);
      $user->save();
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
}
