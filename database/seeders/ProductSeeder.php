<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $imagePool = [
            'photos/Skin care.jfif',
            'photos/download (1).jfif',
            'photos/download (1).webp',
            'photos/download (2).jfif',
            'photos/download (3).jfif',
            'photos/download (4).jfif',
            'photos/download.jfif',
            'photos/download.webp',
            'photos/#bagsandpurses #maroon_.jfif',
        ];
        $imageIndex = 0;

        $catalog = [
            'Electronics' => [
                ['name' => 'Wireless Noise-Canceling Headphones', 'price' => 129.99],
                ['name' => '4K Smart TV 55-inch', 'price' => 499.00],
                ['name' => 'Gaming Mechanical Keyboard', 'price' => 79.50],
            ],
            'Fashion' => [
                ['name' => 'Premium Cotton T-Shirt', 'price' => 24.99],
                ['name' => 'Classic Men Sneakers', 'price' => 59.90],
                ['name' => 'Elegant Women Handbag', 'price' => 89.00],
            ],
            'Beauty' => [
                ['name' => 'Skincare Gift Box', 'price' => 39.99],
                ['name' => 'Long Lasting Perfume', 'price' => 65.00],
                ['name' => 'Natural Face Serum', 'price' => 29.00],
            ],
            'Home & Kitchen' => [
                ['name' => 'Air Fryer 6L', 'price' => 95.00],
                ['name' => 'Stainless Steel Cookware Set', 'price' => 140.00],
            ],
        ];

        foreach ($catalog as $categoryName => $products) {
            $category = Category::updateOrCreate(
                ['name' => $categoryName],
                ['name' => $categoryName, 'description' => "{$categoryName} category products."]
            );

            foreach ($products as $data) {
                Product::updateOrCreate(
                    ['name' => $data['name']],
                    [
                        'category_id' => $category->id,
                        'name' => $data['name'],
                        'description' => "Placeholder description for {$data['name']}. Add your custom marketing copy here.",
                        'price' => $data['price'],
                        'image' => $imagePool[$imageIndex % count($imagePool)],
                    ]
                );
                $imageIndex++;
            }
        }
    }
}
