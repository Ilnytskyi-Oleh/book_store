<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;

class SearchController extends Controller
{
    public function __invoke($authorLastName)
    {
        $books = Book::whereHas('authors', function ($query) use ($authorLastName) {
            $query->where('last_name', 'like', "%{$authorLastName}%");
        })->paginate(10);

        return BookResource::collection($books);
    }
}
