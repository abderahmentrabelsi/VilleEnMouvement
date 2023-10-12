<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        auth()->user()->wishlist()->attach($product->id);

        return back()->with('success', 'Product added to wishlist.');
    }

    public function remove(Product $product)
    {
        auth()->user()->wishlist()->detach($product->id);

        return back()->with('success', 'Product removed from wishlist.');
    }

    public function show()
    {
        $wishlistItems = auth()->user()->wishlist;

        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],
            ['link' => "javascript:void(0)", 'name' => "eCommerce"],
            ['name' => "Wish List"]
        ];

        return view('content.apps.ecommerce.app-ecommerce-wishlist', compact('wishlistItems', 'pageConfigs', 'breadcrumbs'));
    }




}
