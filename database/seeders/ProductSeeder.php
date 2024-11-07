<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'GymShark T-shirt',
            'description' => 'High-quality workout T-shirt',
            'price' => 29.99,
            'stock' => 50,
            'image' => 'Oversized t-shirt.webp',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Hoodie',
            'description' => 'Comfortable and stylish hoodie',
            'price' => 49.99,
            'stock' => 30,
            'image' => 'Hoodie.webp',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Joggers',
            'description' => 'Perfect joggers for workouts and casual wear',
            'price' => 39.99,
            'stock' => 20,
            'image' => 'jogger.webp',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Joggers',
            'description' => 'Perfect joggers for workouts and casual wear',
            'price' => 15.99,
            'stock' => 100,
            'image' => 'joggers.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark shorts',
            'description' => 'High-quality shorts',
            'price' => 19.99,
            'stock' => 40,
            'image' => 'shorts.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);

        // Additional products
        Product::create([
            'name' => 'GymShark Duffle Bag',
            'description' => 'Spacious duffle bag for gym and travel',
            'price' => 55.00,
            'stock' => 25,
            'image' => 'feat.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Tank Top',
            'description' => 'Stylish tank for workouts and daily wear',
            'price' => 12.99,
            'stock' => 60,
            'image' => 'tank.png',
            'category' => 'Accessories',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Shorts',
            'description' => 'Breathable shorts for intense workouts',
            'price' => 24.99,
            'stock' => 35,
            'image' => 'shorts.webp',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Sports set',
            'description' => 'Comfortable and supportive sports set',
            'price' => 27.99,
            'stock' => 40,
            'image' => 'ran1.avif',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Sweatpants',
            'description' => 'Cozy sweatpants for workouts and lounging',
            'price' => 34.99,
            'stock' => 28,
            'image' => 'joggers.webp',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark shirt',
            'description' => 'Durable shirt for everyday use',
            'price' => 45.99,
            'stock' => 18,
            'image' => 'tshirt2.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark stringer',
            'description' => 'Stringer for comfortable workouts',
            'price' => 29.99,
            'stock' => 45,
            'image' => 'string.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark Tank Top',
            'description' => 'Lightweight tank top for gym sessions',
            'price' => 21.99,
            'stock' => 55,
            'image' => 'String2.webp',
            'category' => 'Apparel',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark shorts',
            'description' => 'Comfortable and durable shorts',
            'price' => 9.99,
            'stock' => 75,
            'image' => 'f2.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);

        Product::create([
            'name' => 'GymShark shorts',
            'description' => 'Comfortable and durable shorts',
            'price' => 14.99,
            'stock' => 50,
            'image' => 'f4.webp',
            'category' => 'Accessories',
            'status' => true,
        ]);
    }
}
