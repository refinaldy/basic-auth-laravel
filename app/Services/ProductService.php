<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Carbon;

/**
 * Class ProductService.
 */
class ProductService
{

  public function addProduct($payload){
    $product = Product::create([
        'name' => $payload['name'],
        'price' => $payload['price'],
        'description' => $payload['description'],
        'published_at' => Carbon::now(),
    ]);

    $images = array();
    foreach($payload['images'] as $image){
        $path = $image->store('products', 'public');
        $images[] = [
            'product_id' => $product->id,
            'path' => $path,
        ];
    }

    ProductImage::insert($images);

    return $product;
  }

  



}
