<?php

namespace App\Http\Controllers\Api\V1\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;

class IndexController extends Controller
{
    public function __invoke()
    {
        return BookResource::collection(Book::with('authors')->paginate(10));
    }
}
