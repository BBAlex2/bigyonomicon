<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test category relationships.
     */
    public function test_category_relationships(): void
    {
        // Create a main category
        $mainCategory = Category::create([
            'name' => 'Test Main Category',
            'type' => 'main',
        ]);

        // Create a subcategory
        $subCategory = Category::create([
            'name' => 'Test Subcategory',
            'type' => 'sub',
            'parent_id' => $mainCategory->id,
        ]);

        // Create a product with the main category
        $product1 = Product::create([
            'name' => 'Test Product 1',
            'description' => 'This is a test product',
            'price' => 10000,
            'image' => 'test-image.jpg',
            'option2_image' => 'test-option2-image.jpg',
            'rating' => 4.5,
            'rating_count' => 10,
            'category_id' => $mainCategory->id,
            'subcategory_id' => $subCategory->id,
        ]);

        // Create a product with the subcategory
        $product2 = Product::create([
            'name' => 'Test Product 2',
            'description' => 'This is another test product',
            'price' => 20000,
            'image' => 'test-image-2.jpg',
            'option2_image' => 'test-option2-image-2.jpg',
            'rating' => 3.5,
            'rating_count' => 5,
            'category_id' => $subCategory->id,
            'subcategory_id' => $mainCategory->id,
        ]);

        // Test subcategories relationship
        $this->assertCount(1, $mainCategory->subcategories);
        $this->assertEquals($subCategory->id, $mainCategory->subcategories->first()->id);

        // Test parent relationship
        $this->assertEquals($mainCategory->id, $subCategory->parent_id);

        // Test products relationship
        $this->assertCount(1, $mainCategory->products);
        $this->assertEquals($product1->id, $mainCategory->products->first()->id);

        // Test productsAsSubcategory relationship
        $this->assertCount(1, $mainCategory->productsAsSubcategory);
        $this->assertEquals($product2->id, $mainCategory->productsAsSubcategory->first()->id);
    }

    /**
     * Test category creation.
     */
    public function test_category_creation(): void
    {
        // Create a main category
        $mainCategory = Category::create([
            'name' => 'Test Main Category',
            'type' => 'main',
        ]);

        // Create a subcategory
        $subCategory = Category::create([
            'name' => 'Test Subcategory',
            'type' => 'sub',
            'parent_id' => $mainCategory->id,
        ]);

        // Assert the categories were created
        $this->assertDatabaseHas('categories', [
            'name' => 'Test Main Category',
            'type' => 'main',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Subcategory',
            'type' => 'sub',
            'parent_id' => $mainCategory->id,
        ]);
    }

    /**
     * Test category update.
     */
    public function test_category_update(): void
    {
        // Create a category
        $category = Category::create([
            'name' => 'Test Category',
            'type' => 'main',
        ]);

        // Update the category
        $category->name = 'Updated Test Category';
        $category->save();

        // Assert the category was updated
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Test Category',
            'type' => 'main',
        ]);
    }

    /**
     * Test category deletion.
     */
    public function test_category_deletion(): void
    {
        // Create a category
        $category = Category::create([
            'name' => 'Test Category',
            'type' => 'main',
        ]);

        // Delete the category
        $category->delete();

        // Assert the category was deleted
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
