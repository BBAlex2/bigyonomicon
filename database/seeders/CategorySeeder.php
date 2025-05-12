<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main categories
        $categories = [
            ['name' => 'Bútor', 'type' => 'main'],
            ['name' => 'Elektronika', 'type' => 'main'],
            ['name' => 'Konyhai eszközök', 'type' => 'main'],
            ['name' => 'Sport és szabadidő', 'type' => 'main'],
            ['name' => 'Dekoráció', 'type' => 'main'],
            ['name' => 'Élelmiszer', 'type' => 'main'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Subcategories
        $subcategories = [
            // Bútor subcategories
            ['name' => 'Étkezőasztal', 'type' => 'sub', 'parent_id' => 1],
            ['name' => 'Ülőgarnitúra', 'type' => 'sub', 'parent_id' => 1],
            ['name' => 'Szekrény', 'type' => 'sub', 'parent_id' => 1],
            ['name' => 'Ágy', 'type' => 'sub', 'parent_id' => 1],
            ['name' => 'Szék', 'type' => 'sub', 'parent_id' => 1],
            ['name' => 'Íróasztal', 'type' => 'sub', 'parent_id' => 1],
            ['name' => 'Lámpa', 'type' => 'sub', 'parent_id' => 1],

            // Elektronika subcategories
            ['name' => 'Televízió', 'type' => 'sub', 'parent_id' => 2],
            ['name' => 'Laptop', 'type' => 'sub', 'parent_id' => 2],
            ['name' => 'Okosóra', 'type' => 'sub', 'parent_id' => 2],
            ['name' => 'Okostelefon', 'type' => 'sub', 'parent_id' => 2],
            ['name' => 'Audió eszköz', 'type' => 'sub', 'parent_id' => 2],

            // Konyhai eszközök subcategories
            ['name' => 'Edény', 'type' => 'sub', 'parent_id' => 3],
            ['name' => 'Robotgép', 'type' => 'sub', 'parent_id' => 3],
            ['name' => 'Kávéfőző', 'type' => 'sub', 'parent_id' => 3],
            ['name' => 'Hűtőszekrény', 'type' => 'sub', 'parent_id' => 3],

            // Sport és szabadidő subcategories
            ['name' => 'Kerékpár', 'type' => 'sub', 'parent_id' => 4],
            ['name' => 'Kézigránát', 'type' => 'sub', 'parent_id' => 4],

            // Dekoráció subcategories
            ['name' => 'Váza', 'type' => 'sub', 'parent_id' => 5],

            // Élelmiszer subcategories
            ['name' => 'Gyümölcs', 'type' => 'sub', 'parent_id' => 6],
        ];

        foreach ($subcategories as $subcategory) {
            Category::create($subcategory);
        }
    }
}
