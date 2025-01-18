<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $imageName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->storeAs('images', $imageName);
        $product = new Product([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'qty'=>$request->qty,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>'/images/' . $imageName,
        ]);

        $save = $product->save();
        if($save){
            return redirect()->route('products.index');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $imageName = explode('/', $product->image);
        $imageName = $imageName[count($imageName) - 1];
        if ($request->has('image')) {
            $imageName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName);
            if (file_exists(public_path('storage'.$product->image))){
                unlink(public_path('storage'.$product->image));
            }
        }
        $update = $product->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'qty'=>$request->qty,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>'/images/' . $imageName,
        ]);
        if($update){
            return redirect()->route('products.index');
        }else {
            return redirect()->back()->withErrors(['msg' => 'Gagal mengedit produk, Coba lagi!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (file_exists(public_path('storage'.$product->image))){
            unlink(public_path('storage'.$product->image));
        }
        $delete = $product->delete();
        if($delete){
            return redirect()->route('products.index');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Gagal hapus produk, Coba lagi!']);
        }
    }
}
