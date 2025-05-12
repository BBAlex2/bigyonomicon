<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update product categories directly in the database
        DB::table('products')->where('id', 1)->update([
            'category_id' => 1, // Bútor
            'subcategory_id' => 4, // Étkezőasztal
        ]);

        DB::table('products')->where('id', 2)->update([
            'category_id' => 1, // Bútor
            'subcategory_id' => 5, // Ülőgarnitúra
        ]);

        DB::table('products')->where('id', 3)->update([
            'category_id' => 1, // Bútor
            'subcategory_id' => 6, // Szekrény
        ]);

        DB::table('products')->where('id', 4)->update([
            'category_id' => 1, // Bútor
            'subcategory_id' => 7, // Íróasztal
        ]);

        DB::table('products')->where('id', 5)->update([
            'category_id' => 5, // Dekoráció
            'subcategory_id' => 8, // Lámpa
        ]);

        DB::table('products')->where('id', 6)->update([
            'category_id' => 5, // Dekoráció
            'subcategory_id' => 18, // Váza
        ]);

        DB::table('products')->where('id', 7)->update([
            'category_id' => 6, // Élelmiszer
            'subcategory_id' => 19, // Gyümölcs
        ]);

        DB::table('products')->where('id', 8)->update([
            'category_id' => 6, // Élelmiszer
            'subcategory_id' => 19, // Gyümölcs
        ]);

        DB::table('products')->where('id', 9)->update([
            'category_id' => 6, // Élelmiszer
            'subcategory_id' => 19, // Gyümölcs
        ]);

        DB::table('products')->where('id', 10)->update([
            'category_id' => 6, // Élelmiszer
            'subcategory_id' => 19, // Gyümölcs
        ]);

        DB::table('products')->where('id', 11)->update([
            'category_id' => 6, // Élelmiszer
            'subcategory_id' => 19, // Gyümölcs
        ]);

        DB::table('products')->where('id', 12)->update([
            'category_id' => 6, // Élelmiszer
            'subcategory_id' => 19, // Gyümölcs
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
