<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model
//import this view app-ecommerce-shop


class ProductController extends Controller
{
    public function index()
    {
        $pageConfigs = [
            'contentLayout' => "content-detached-left-sidebar",
            'pageClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "eCommerce"], ['name' => "Shop"]
        ];

        $products = Product::all();

        return view('content.apps.ecommerce.app-ecommerce-shop', compact('pageConfigs', 'breadcrumbs', 'products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'image_url' => 'required|url',
            'rating' => 'required|integer|min:1|max:5',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'company_name' => 'required|string',
        ]);

        // Create a new product using the validated data
        Product::create($request->all());

        // Redirect to the product listing page
        return response()->json(['message' => 'Product created successfully', 'data' => $request], 201);
    }

    public function show($id)
    {
        // Fetch the product details by the $id parameter
        $product = Product::find($id);

        // Display the product details in the view
//display the object when you find it
        return response()->json(['message' => 'Product retrieved successfully', 'data' => $product], 200);
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function ecommerce_details($productId)
    {
        $product = Product::find($productId); // Replace 'Product' with your actual model and fetch the product by its ID

        if ($product) {
            $pageConfigs = [
                'pageClass' => 'ecommerce-application',
            ];

            $breadcrumbs = [
                ['link' => "/", 'name' => "Home"],
                ['link' => "javascript:void(0)", 'name' => "eCommerce"],
                ['link' => "/app/ecommerce/shop", 'name' => "Shop"],
                ['name' => "Details"]
            ];

            return view('content/apps/ecommerce/app-ecommerce-details', [
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,
                'product' => $product, // Pass the product details to the view
            ]);
        }

        // Handle the case where the product is not found
        // You can redirect or display an error message.
    }


    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'image_url' => 'required|url',
            'rating' => 'required|integer|min:1|max:5',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'company_name' => 'required|string',
        ]);

        // Update the product using the validated data
        $product->update($request->all());

        // Redirect to the product detail page
        return redirect("/products/{$product->id}");
    }

    public function destroy(Product $product)
    {
        // Delete the product from the database
        $product->delete();

        // Redirect to the product listing page
        return redirect('/products');
    }
}
