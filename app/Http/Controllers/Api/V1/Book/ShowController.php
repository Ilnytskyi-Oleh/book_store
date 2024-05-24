<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;

class ShowController extends Controller
{
    public function __invoke(Book $book)
    {
        return new BookResource($book->load('authors'));
    }
}
