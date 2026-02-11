<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_members_can_view_books_index(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $response = $this->actingAs($user)->get(route('books.index'));

        $response->assertOk();
        $response->assertSee($book->title);
    }

    public function test_books_index_can_filter_by_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Book::factory()->create(['category_id' => $category->id]);
        $otherBook = Book::factory()->create();

        $response = $this->actingAs($user)->get(route('books.index', ['category_id' => $category->id]));

        $response->assertOk();
        $response->assertSee($category->name);
    }

    public function test_admin_can_create_book(): void
    {
        $admin = User::factory()->withRole('admin')->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->post(route('books.store'), [
            'title' => 'New Book',
            'author' => 'Author Name',
            'category_id' => $category->id,
            'description' => 'A description',
            'total_quantity' => 5,
        ]);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', ['title' => 'New Book', 'available_quantity' => 5]);
    }

    public function test_members_cannot_access_create_book_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('books.create'));

        $response->assertForbidden();
    }

    public function test_guest_cannot_view_books(): void
    {
        $response = $this->get(route('books.index'));

        $response->assertRedirect();
    }
}
