<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\AddProductRequest;
use App\Http\Resources\GetListProductResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(
                'images:product_id,path', 
                'ratings:product_id,user_id,rating'
                )->paginate($request->limit ? $request->limit : 10);
        
        return response()->json([
            'status' => 'success',
            'data' => GetListProductResource::collection($products),
        ], Response::HTTP_OK);;
    }

    public function store(AddProductRequest $request){
        try{
            $payload = $request->all();
            
            $product = Product::create([
                'name' => $payload['name'],
                'price' => $payload['price'],
                'description' => $payload['description'],
                'published_at' => \Carbon\Carbon::now(),
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $product,
            ], Response::HTTP_CREATED);
        }catch(\Exception $err){
            return response()->json([
                'status' => 'error',
                'message' => $err->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(Request $request, $id){
        try {
            $product = Product::with(
                'images:product_id,path', 
                'ratings:product_id,user_id,rating'
                )->whee('id', $id)->first();

            if(!$product){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found',
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => 'success',
                'data' => new GetListProductResource($product),
            ], Response::HTTP_OK);
            
        } catch (\Exception $err) {
            Log::info('Error function get detail product: ');
            Log::error($err->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => "Something wen't wrong",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
