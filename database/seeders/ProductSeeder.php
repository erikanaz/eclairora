<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Classic Chocolate Éclair',
                'description' => 'Éclair lembut dengan krim coklat premium.',
                'price' => 25000,
                'image' => 'choc_eclair.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Vanilla Dream Éclair',
                'description' => 'Éclair dengan isian vanilla bean.',
                'price' => 22000,
                'image' => 'vanilla_eclair.jpg'
            ],
            [
                'category_id' => 2,
                'name' => 'Custard Cream Puff',
                'description' => 'Cream puff dengan custard lembut.',
                'price' => 18000,
                'image' => 'custard_puff.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Strawberry Mini Tart',
                'description' => 'Tart mini dengan strawberry segar.',
                'price' => 28000,
                'image' => 'strawberry_tart.jpg'
            ],
            [
                'category_id' => 4,
                'name' => 'Butter Cookies Box',
                'description' => 'Cookies renyah dengan aroma butter.',
                'price' => 30000,
                'image' => 'butter_cookies.jpg'
            ],
            [
                'category_id' => 5,
                'name' => 'Soft Milk Bun',
                'description' => 'Roti lembut rasa susu premium.',
                'price' => 15000,
                'image' => 'milk_bun.jpg'
            ],
        ]);
    }
}
