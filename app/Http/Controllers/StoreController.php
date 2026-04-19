<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     { 
    //$productsQuery = Product::query()->orderBY('created_at','desc')->limit(3)->get();
  
   
    
    $name = $request->input('name');
    $categoriesId = $request->input('categories');
    $categoriesSelect = $request->input('categoriesii');
    
    $max = $request->input('max');
    $min = $request->input('min');
    $productsQuery = Product::query();
    $categories = Category::with('products')->has('products')->get()->all();
    //dd($categories);
    if(!empty($name)){
        $productsQuery->where('name','like',"%{$name}%" );
     }

      if(!empty($categoriesId)){
       // $productsQuery->where('category_id','like',$categoriesId );
        $productsQuery->whereIn('category_id',$categoriesId );
     }
      if(!empty($categoriesSelect)){
       // $productsQuery->where('category_id','like',$categoriesId );
        $productsQuery->whereIn('category_id',$categoriesSelect );
     }

       if(!empty($min)){
        $productsQuery->where('price', '>=', $min);
     }
       if(!empty($max)){
        $productsQuery->where('price', '<=', $max);
     }

     $products = $productsQuery->get();
        return view('store.index',compact('products','categories'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $products = new Product();
         $products->quantity = 0;
         $isUpdate = false;
        return view('users.admin.product.form',compact('products','isUpdate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
       //dd($request->validated());
        $formFields = $request->validated();
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store("product","public");
         }
       //dd($formFields);
       Product::create($formFields);

       return to_route('products.index')->with("success","Product create successfully");
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $products = $product;
        $isUpdate = true;
        return view('users.admin.product.form',compact('products','isUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $formFields = $request->validated();
        $product->fill($formFields)->save(); 
       //   dd($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {    
     $product->delete();
     return to_route('products.index')->with("success","Product deleted successfully");
        //dd($product);
    }
}
