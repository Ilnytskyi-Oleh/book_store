<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_author()
    {
        $data = [
            'last_name' => 'Doe',
            'first_name' => 'John',
            'middle_name' => 'A',
        ];

        $response = $this->postJson('/api/v1/authors', $data);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'last_name' => 'Doe',
                'first_name' => 'John',
            ]);

        $this->assertDatabaseHas('authors', $data);
    }

    public function test_index_authors()
    {
        Author::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/authors');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'last_name', 'first_name', 'middle_name']
                ]
            ]);
    }

    public function test_show_author()
    {
        $author = Author::factory()->create();

        $response = $this->getJson('/api/v1/authors/' . $author->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'last_name' => $author->last_name,
            ]);
    }

    public function test_update_author()
    {
        $author = Author::factory()->create();

        $data = [
            'last_name' => 'Smith',
            'first_name' => 'John',
            'middle_name' => 'B',
        ];

        $response = $this->putJson('/api/v1/authors/' . $author->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'last_name' => 'Smith',
            ]);

        $this->assertDatabaseHas('authors', $data);
    }

    public function test_delete_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson('/api/v1/authors/' . $author->id);

        $response->assertStatus(204);

        $this->assertSoftDeleted('authors', ['id' => $author->id]);    }
}
