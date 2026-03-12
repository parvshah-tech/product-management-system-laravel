<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(12);
        $total = Product::count();

        return view('products.index', compact('products', 'total'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'feature_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $featureImagePaths = [];
        $galleryImagePath = null;

        if ($request->hasFile('gallery_image')) {
            $galleryImagePath = $request->file('gallery_image')->store('products/gallery', 'public');
        } else {
            $galleryImagePath = null;
        }

        if ($request->hasFile('feature_images')) {
            foreach ($request->file('feature_images') as $featureImage) {
                $featureImagePaths[] = $featureImage->store('products/feature', 'public');
            }
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'gallery_image' => $galleryImagePath,
            'feature_images' => $featureImagePaths,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'feature_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $featureImagePaths = $product->feature_images;
        $galleryImagePath = $product->gallery_image;

        if ($request->hasFile('gallery_image')) {
            $galleryImagePath = $request->file('gallery_image')->store('products/gallery', 'public');
        }

        if ($request->hasFile('feature_images')) {
            $featureImagePaths = [];
            foreach ($request->file('feature_images') as $featureImage) {
                $featureImagePaths[] = $featureImage->store('products/feature', 'public');
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'gallery_image' => $galleryImagePath,
            'feature_images' => $featureImagePaths,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
