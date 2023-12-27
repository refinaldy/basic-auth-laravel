<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
    ){
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(
                'images:product_id,path', 
                'ratings:product_id,user_id,rating'
                )->select()->get();
        
        return view('products.index', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        try {
            $payload = $request->all();
            
            DB::beginTransaction();
            $product = $this->productService->addProduct($payload);
            
            DB::commit();
    } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->where('id', $id)->firstOrFail();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $payload = $request->validated();
            $product = Product::where('id', $id)->first();

            if(!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            if($request->hasFile('image')){
                $payload['image'] = $request->file('image');
                $path = $request->file('image')->store('products', 'public');
            } 

            $product->update([
                'name' => $payload['name'],
                'price' => $payload['price'],
                'description' => $payload['description'],
                'image_path' => $path ?? $product->image_path,
            ]);

            DB::commit();

            return redirect()->route('products.index');
        } catch (\Throwable $th) {
            DB::rollback();
            Log::info("Error updating product");
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();

        if(!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
