<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['category_id' => 1, 'name' => 'Nike Air Max', 'description' => 'Odlične patike za svaki dan.', 'price' => 15000, 'image' => 'img/product/p1.jpg'],
            ['category_id' => 2, 'name' => 'Adidas Ultraboost', 'description' => 'Najudobnije patike za trčanje.', 'price' => 18500, 'image' => 'img/product/p2.jpg'],
            ['category_id' => 3, 'name' => 'Jordan Retro 4', 'description' => 'Klasika za košarku.', 'price' => 24000, 'image' => 'img/product/p3.jpg'],
            ['category_id' => 1, 'name' => 'Puma Suede', 'description' => 'Retro stil koji ne prolazi.', 'price' => 8500, 'image' => 'img/product/p4.jpg'],
            ['category_id' => 2, 'name' => 'Asics Gel-Kayano', 'description' => 'Vrhunska podrška pri trčanju.', 'price' => 16000, 'image' => 'img/product/p5.jpg'],
            ['category_id' => 1, 'name' => 'Converse All Star', 'description' => 'Popularne starke.', 'price' => 6500, 'image' => 'img/product/p6.jpg'],

            ['category_id' => 3, 'name' => 'Nike Zoom Freak', 'description' => 'Patike za vrhunske performanse na terenu.', 'price' => 14500, 'image' => 'img/product/p7.jpg'],
            ['category_id' => 1, 'name' => 'Reebok Classic', 'description' => 'Bezvremenski dizajn i udobnost.', 'price' => 9000, 'image' => 'img/product/p8.jpg'],
            ['category_id' => 2, 'name' => 'New Balance 574', 'description' => 'Savršena ravnoteža stila i funkcionalnosti.', 'price' => 11000, 'image' => 'img/product/p1.jpg'],
            ['category_id' => 3, 'name' => 'Under Armour Curry', 'description' => 'Potpisana serija za precizan šut.', 'price' => 17000, 'image' => 'img/product/p2.jpg'],
            ['category_id' => 1, 'name' => 'Vans Old Skool', 'description' => 'Omiljeni izbor skejtera širom sveta.', 'price' => 7500, 'image' => 'img/product/p3.jpg'],
            ['category_id' => 2, 'name' => 'Mizuno Wave Rider', 'description' => 'Inovativna tehnologija za maratonce.', 'price' => 13500, 'image' => 'img/product/p4.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
