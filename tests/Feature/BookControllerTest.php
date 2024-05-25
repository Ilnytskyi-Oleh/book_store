<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_book()
    {
        $author = Author::factory()->create();

        $data = [
            'title' => 'New Book',
            'description' => 'Book description',
            'published_at' => now()->year,
            'authors' => [$author->id],
        ];

        $response = $this->postJson('/api/v1/books', $data);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'title' => 'New Book',
            ]);

        $this->assertDatabaseHas('books', ['title' => 'New Book']);
        $this->assertDatabaseHas('author_book', ['author_id' => $author->id]);
    }

    public function test_index_books()
    {
        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/books');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'description', 'published_at']
                ]
            ]);
    }

    public function test_show_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson('/api/v1/books/' . $book->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => $book->title,
            ]);
    }

    public function test_update_book()
    {
        $book = Book::factory()->create();

        $data = [
            'title' => 'Updated Book Title',
            'description' => 'Updated description',
            'published_at' => now()->year,
        ];

        $response = $this->putJson('/api/v1/books/' . $book->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Updated Book Title',
            ]);

        $this->assertDatabaseHas('books', $data);
    }

    public function test_delete_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson('/api/v1/books/' . $book->id);

        $response->assertStatus(204);

        $this->assertSoftDeleted('books', ['id' => $book->id]);
    }

    public function test_search_books_by_author()
    {
        $author = Author::factory()->create(['last_name' => 'Smith']);
        $book = Book::factory()->create();
        $book->authors()->attach($author);

        $response = $this->getJson('/api/v1/books/search/Smith');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => $book->title,
            ]);
    }
}
