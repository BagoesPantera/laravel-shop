<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category([
            'name'=>$request->name,
        ]);

        $save = $category->save();
        if($save){
            return redirect()->route('categories.index');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Gagal membuat kategori, Coba lagi!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $update = $category->update([
            'name' => $request->get('name'),
        ]);
        if($update){
            return redirect()->route('categories.index');
        }else {
            return redirect()->back()->withErrors(['msg' => 'Gagal mengedit kategori, Coba lagi!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $delete = $category->delete();
        if($delete){
            return redirect()->route('categories.index');
        }else{
            return redirect()->back()->withErrors(['msg' => 'Gagal hapus kategori, Coba lagi!']);
        }
    }
}
