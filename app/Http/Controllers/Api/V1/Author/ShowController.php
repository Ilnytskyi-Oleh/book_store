<?php

namespace App\Http\Controllers\Api\V1\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

class ShowController extends Controller
{
    public function __invoke(Author $author)
    {
        return new AuthorResource($author);
    }
}
