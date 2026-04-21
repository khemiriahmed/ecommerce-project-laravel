<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        //$products = Product::query()->get();
        //$products = Product::get();
        ///$products;
        $products = Product::query()->with('category')->paginate(10);
        return view('users.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Product();
        $categories = Category::all();
        $products->quantity = 0;
        $isUpdate = false;
        return view('users.admin.product.form', compact('products', 'isUpdate', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        dd($request->validated());
        $formFields = $request->validated();
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store("product", "public");
        }
        //dd($formFields);
        Product::create($formFields);

        return to_route('products.index')->with("success", "Product create successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $products = $product;
        $categories = Category::all();
        $isUpdate = true;
        return view('users.admin.product.form', compact('products', 'isUpdate', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $formFields = $request->validated();
        $product->fill($formFields)->save();
        return to_route('products.index')->with("success", "Product updated successfully");
        //   dd($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('products.index')->with("success", "Product deleted successfully");
        //dd($product);
    }
}
