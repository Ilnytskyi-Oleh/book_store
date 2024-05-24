<?php

namespace App\Http\Controllers\Api\V1\Author;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return AuthorResource::collection(Author::paginate(10));
    }
}
