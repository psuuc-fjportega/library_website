<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_members_can_view_categories_index(): void
    {
        $user = User::factory()->create();
        Category::factory()->count(2)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertOk();
        $response->assertSee(Category::first()->name);
    }

    public function test_members_cannot_access_create_category_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('categories.create'));

        $response->assertForbidden();
    }

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->withRole('admin')->create();

        $response = $this->actingAs($admin)->post(route('categories.store'), [
            'name' => 'Fiction',
            'description' => 'Fiction books',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['name' => 'Fiction']);
    }

    public function test_librarian_can_update_category(): void
    {
        $librarian = User::factory()->withRole('librarian')->create();
        $category = Category::factory()->create(['name' => 'Science']);

        $response = $this->actingAs($librarian)->put(route('categories.update', $category), [
            'name' => 'Science & Technology',
            'description' => $category->description,
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['name' => 'Science & Technology']);
    }

    public function test_guest_cannot_view_categories(): void
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect();
    }
}
