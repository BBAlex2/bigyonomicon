<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test categories
        $mainCategory = Category::create([
            'name' => 'Test Category',
            'type' => 'main',
        ]);

        $subCategory = Category::create([
            'name' => 'Test Subcategory',
            'type' => 'sub',
            'parent_id' => $mainCategory->id,
        ]);

        // Create test products
        Product::create([
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

        Product::create([
            'name' => 'Test Product 2',
            'description' => 'This is another test product',
            'price' => 20000,
            'image' => 'test-image-2.jpg',
            'option2_image' => 'test-option2-image-2.jpg',
            'rating' => 3.5,
            'rating_count' => 5,
            'category_id' => $mainCategory->id,
            'subcategory_id' => $subCategory->id,
        ]);
    }

    /**
     * Test getting all products.
     */
    public function test_get_all_products(): void
    {
        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                        'option2_image',
                        'rating',
                        'rating_count',
                        'category_id',
                        'subcategory_id',
                        'category' => [
                            'id',
                            'name',
                            'type',
                        ],
                        'subcategory' => [
                            'id',
                            'name',
                            'type',
                        ],
                    ]
                ]
            ])
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test getting a single product.
     */
    public function test_get_single_product(): void
    {
        $product = Product::first();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image',
                    'option2_image',
                    'rating',
                    'rating_count',
                    'category_id',
                    'subcategory_id',
                    'category',
                    'subcategory',
                    'comments',
                ]
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                ]
            ]);
    }

    /**
     * Test creating a product.
     */
    public function test_create_product(): void
    {
        $mainCategory = Category::where('type', 'main')->first();
        $subCategory = Category::where('type', 'sub')->first();

        $data = [
            'name' => 'New Test Product',
            'description' => 'This is a new test product',
            'price' => 15000,
            'image' => 'new-test-image.jpg',
            'option2_image' => 'new-test-option2-image.jpg',
            'rating' => 4.0,
            'rating_count' => 8,
            'category_id' => $mainCategory->id,
            'subcategory_id' => $subCategory->id,
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image',
                    'option2_image',
                    'rating',
                    'rating_count',
                    'category_id',
                    'subcategory_id',
                ]
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'New Test Product',
                    'description' => 'This is a new test product',
                    'price' => 15000,
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'New Test Product',
            'description' => 'This is a new test product',
            'price' => 15000,
        ]);
    }

    /**
     * Test updating a product.
     */
    public function test_update_product(): void
    {
        $product = Product::first();

        $data = [
            'name' => 'Updated Test Product',
            'description' => 'This is an updated test product',
            'price' => 25000,
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image',
                    'option2_image',
                    'rating',
                    'rating_count',
                    'category_id',
                    'subcategory_id',
                ]
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'name' => 'Updated Test Product',
                    'description' => 'This is an updated test product',
                    'price' => 25000,
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Test Product',
            'description' => 'This is an updated test product',
            'price' => 25000,
        ]);
    }

    /**
     * Test deleting a product.
     */
    public function test_delete_product(): void
    {
        $product = Product::first();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ])
            ->assertJson([
                'success' => true,
                'message' => 'Product deleted successfully',
            ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
