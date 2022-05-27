<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    public function testApiProductGetCatalog()
    {
        Product::factory()->count(11)->create();;
        $response = $this->get('/api/catalog')->assertStatus(200);;
        $response->assertJson(fn(AssertableJson $json) => $json->has('items', 11));

        // add some product
        Product::factory()->count(4)->create();;
        $response = $this->get('/api/catalog')->assertStatus(200);;
        $response->assertJson(fn(AssertableJson $json) => $json->has('items', 15));
    }

}
