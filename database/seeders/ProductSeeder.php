<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        collect([
           [
            'user_id' => 1,
            'name' => 'Product 1',
            'price' => 1000,
            'description' => 'Deskripsi Produk',
            'published_at' => \Carbon\Carbon::now(),
            'url' => null,
           ],
           [
            'user_id' => 1,
            'name' => 'Product 2',
            'price' => 2000,
            'description' => 'Deskripsi Produk 2',
            'published_at' => \Carbon\Carbon::now(),
            'url' => null,
           ],
           [
            'user_id' => 1,
            'name' => 'Product 3',
            'price' => 2000,
            'description' => 'Deskripsi Produk 2',
            'published_at' => \Carbon\Carbon::now(),
            'url' => 'https://tokopedia.com/',
           ],
           [
            'user_id' => 2,
            'name' => 'Product 1',
            'price' => 1000,
            'description' => 'Deskripsi Produk',
            'published_at' => \Carbon\Carbon::now(),
            'url' => null,
           ],
           [
            'user_id' => 2,
            'name' => 'Product 2',
            'price' => 2000,
            'description' => 'Deskripsi Produk 2',
            'published_at' => \Carbon\Carbon::now(),
            'url' => null,
           ],
           [
            'user_id' => 1,
            'name' => 'Product 3',
            'price' => 2000,
            'description' => 'Deskripsi Produk 2',
            'published_at' => \Carbon\Carbon::now(),
            'url' => 'https://tokopedia.com/',
           ],
        ])->each(fn ($product) => \App\Models\Product::create($product));

        $products = \App\Models\Product::get();


        $products->each(function ($product) {
            $product->images()->create([
                'path' => 'https://picsum.photos/seed/' . $product->id . '/200/300',
            ]);
        });
    }
}
