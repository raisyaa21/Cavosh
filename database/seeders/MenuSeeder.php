<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
    'name' => 'Caramel Latte',
    'price' => 25000,
    'stock' => 5,
    'image' => 'https://www.pumpkinnspice.com/wp-content/uploads/2022/07/IMG_1386.jpg'
]);

Menu::create([
    'name' => 'Cappuccino',
    'price' => 22000,
    'stock' => 5,
    'image' => 'https://www.acouplecooks.com/wp-content/uploads/2020/10/how-to-make-cappuccino-005.jpg'
]);

Menu::create([
    'name' => 'Croissant',
    'price' => 18000,
    'stock' => 5,
    'image' => 'https://wildwildwhisk.com/wp-content/uploads/2018/04/How-to-make-Croissant-baked-2.jpg'
]);

Menu::create([
    'name' => 'Chocolate Bread',
    'price' => 15000,
    'stock' => 5,
    'image' => 'https://kioskcokelat.com/cdn/shop/articles/img-1717246784720_1200x.jpg?v=1737706570'
]);

Menu::create([
    'name' => 'Americano',
    'price' => 20000,
    'stock' => 5,
    'image' => 'https://images.unsplash.com/photo-1551030173-122aabc4489c'
]);

Menu::create([
    'name' => 'Mocha Latte',
    'price' => 28000,
    'stock' => 5,
    'image' => 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e'
]);

Menu::create([
    'name' => 'Cheese Cake',
    'price' => 30000,
    'stock' => 5,
    'image' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad'
]);

Menu::create([
    'name' => 'Donut',
    'price' => 17000,
    'stock' => 5,
    'image' => 'https://larissabakery.id/wp-content/uploads/2025/02/Rekomendasi-Donat-Larissa-Bakery.webp'
]);
    }
}