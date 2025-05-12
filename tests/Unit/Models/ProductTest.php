<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected $mainCategory;
    protected $subCategory;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test categories
        $this->mainCategory = Category::create([
            'name' => 'Test Main Category',
            'type' => 'main',
        ]);

        $this->subCategory = Category::create([
            'name' => 'Test Subcategory',
            'type' => 'sub',
            'parent_id' => $this->mainCategory->id,
        ]);
    }

    /**
     * Test product relationships.
     */
    public function test_product_relationships(): void
    {
        // Create a user for comments
        $user = User::factory()->create();

        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 10000,
            'image' => 'test-image.jpg',
            'option2_image' => 'test-option2-image.jpg',
            'rating' => 4.5,
            'rating_count' => 10,
            'category_id' => $this->mainCategory->id,
            'subcategory_id' => $this->subCategory->id,
        ]);

        // Create comments for the product
        $comment1 = Comment::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'content' => 'This is a test comment',
            'rating' => 4,
        ]);

        $comment2 = Comment::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'content' => 'This is another test comment',
            'rating' => 5,
        ]);

        // Test category relationship
        $this->assertEquals($this->mainCategory->id, $product->category->id);
        $this->assertEquals('Test Main Category', $product->category->name);

        // Test subcategory relationship
        $this->assertEquals($this->subCategory->id, $product->subcategory->id);
        $this->assertEquals('Test Subcategory', $product->subcategory->name);

        // Test comments relationship
        $this->assertCount(2, $product->comments);
        $this->assertEquals($comment1->id, $product->comments[0]->id);
        $this->assertEquals($comment2->id, $product->comments[1]->id);
    }

    /**
     * Test product creation.
     */
    public function test_product_creation(): void
    {
        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 10000,
            'image' => 'test-image.jpg',
            'option2_image' => 'test-option2-image.jpg',
            'rating' => 4.5,
            'rating_count' => 10,
            'category_id' => $this->mainCategory->id,
            'subcategory_id' => $this->subCategory->id,
        ]);

        // Assert the product was created
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 10000,
            'image' => 'test-image.jpg',
            'option2_image' => 'test-option2-image.jpg',
            'rating' => 4.5,
            'rating_count' => 10,
            'category_id' => $this->mainCategory->id,
            'subcategory_id' => $this->subCategory->id,
        ]);
    }

    /**
     * Test product update.
     */
    public function test_product_update(): void
    {
        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 10000,
            'image' => 'test-image.jpg',
            'option2_image' => 'test-option2-image.jpg',
            'rating' => 4.5,
            'rating_count' => 10,
            'category_id' => $this->mainCategory->id,
            'subcategory_id' => $this->subCategory->id,
        ]);

        // Update the product
        $product->name = 'Updated Test Product';
        $product->description = 'This is an updated test product';
        $product->price = 15000;
        $product->save();

        // Assert the product was updated
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Test Product',
            'description' => 'This is an updated test product',
            'price' => 15000,
        ]);
    }

    /**
     * Test product deletion.
     */
    public function test_product_deletion(): void
    {
        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 10000,
            'image' => 'test-image.jpg',
            'option2_image' => 'test-option2-image.jpg',
            'rating' => 4.5,
            'rating_count' => 10,
            'category_id' => $this->mainCategory->id,
            'subcategory_id' => $this->subCategory->id,
        ]);

        // Delete the product
        $product->delete();

        // Assert the product was deleted
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
