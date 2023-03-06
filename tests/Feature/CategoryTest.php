<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_index_has_categories()
    {
        $user = User::factory(1)->create()->first();
        $this->actingAs($user);
        Category::factory(3)->create();
        $response = $this->get(route('categories.index'));
        $response->assertViewHas('categories');
        $response->assertStatus(200);
    }

    public function test_index_has_no_category()
    {

    }

    public function test_can_update_category()
    {

    }

    public function test_can_delete_category()
    {

    }
}
