<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
// use App\Http\Requests\StoreProductRequest;
// use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all products
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Display a listing of the resource.
     */

    public function guest_search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('is_published', 'yes')
                            ->where(function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%')
                                  ->orWhere('price', 'like', '%' . $query . '%')
                                  ->orWhere('description', 'like', '%' . $query . '%');
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('welcome', compact('products', 'query'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where(function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%')
                                  ->orWhere('price', 'like', '%' . $query . '%')
                                  ->orWhere('description', 'like', '%' . $query . '%');
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('products.search', compact('products', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreProductRequest $request)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->is_published = $request->has('is_published') ? 'yes' : 'no';

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Pass the product instance to the view
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Pass the product to the edit view
        return view('products.edit', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateProductRequest $request, Product $product)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        // Update the product with the validated data
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'is_published' => $request->has('is_published') ? 'yes' : 'no',
        ]);

        // Redirect to a specified route after updating, e.g., back to the products list
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Perform any checks if necessary (e.g., authorization)

        $product->delete();

        // Redirect to a specified route after deletion
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
