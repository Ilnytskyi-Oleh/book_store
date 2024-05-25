<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::factory()->count(50)->create();

        $books->each(function ($book) {
            $authors = Author::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $book->authors()->attach($authors);
        });
    }
}
