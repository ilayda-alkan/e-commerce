<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('title', 'Tecnology')->first();
        if ($category) {
            Product::create(array(
                'title' => 'iphone 11',
                'barcode' => '202401',
                'category_id' => $category->id,
                'status'=> True,
                'quantity'=>5,
                'price'=>30000.99,
            ));
        }
        
    }
}
