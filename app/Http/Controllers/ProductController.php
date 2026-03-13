<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function getSubcategories($id)
    {
        $subcategories = Category::where('parent_id', $id)->get();

        return response()->json($subcategories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->get();

        return view('products.create', compact('categories'));
    }

    private function generateSku()
    {
        $lastProduct = Product::latest()->first();

        $number = $lastProduct ? $lastProduct->id + 1 : 1;

        $random = strtoupper(substr(md5(uniqid()), 0, 6));

        return 'PROD-'.$random.$number;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'feature_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $featureImagePaths = [];
        $galleryImagePath = null;

        if ($request->hasFile('gallery_image')) {
            $galleryImagePath = $request->file('gallery_image')->store('products/gallery', 'public');
        }

        if ($request->hasFile('feature_images')) {
            foreach ($request->file('feature_images') as $featureImage) {
                $featureImagePaths[] = $featureImage->store('products/feature', 'public');
            }
        }

        Product::create([
            'sku' => $this->generateSku(),
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id,
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
        $categories = Category::where('parent_id', null)->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'feature_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $featureImagePaths = $product->feature_images ?? [];
        $galleryImagePath = $product->gallery_image ?? null;

        if ($request->has('remove_feature_images')) {
            $toRemove = json_decode($request->remove_feature_images, true);

            $featureImagePaths = array_filter($featureImagePaths, function ($img) use ($toRemove) {
                return ! in_array($img, $toRemove);
            });

            foreach ($toRemove as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        if ($request->hasFile('gallery_image')) {
            if ($product->gallery_image && Storage::disk('public')->exists($product->gallery_image)) {
                Storage::disk('public')->delete($product->gallery_image);
            }

            $galleryImagePath = $request->file('gallery_image')->store('products/gallery', 'public');
        }

        if ($request->hasFile('feature_images')) {
            foreach ($request->file('feature_images') as $featureImage) {
                $featureImagePaths[] = $featureImage->store('products/feature', 'public');
            }
        }

        $product->update([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'category_id' => $request->category_id,
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
        if ($product->gallery_image && Storage::disk('public')->exists($product->gallery_image)) {
            Storage::disk('public')->delete($product->gallery_image);
        }

        if ($product->feature_images) {
            $featureImages = $product->feature_images;

            if (is_array($featureImages)) {
                foreach ($featureImages as $featureImage) {
                    if (Storage::disk('public')->exists($featureImage)) {
                        Storage::disk('public')->delete($featureImage);
                    }
                }
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
