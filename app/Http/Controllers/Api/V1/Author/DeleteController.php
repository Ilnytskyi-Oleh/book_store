<?php

namespace App\Http\Controllers\Api\V1\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;

class DeleteController extends Controller
{
    public function __invoke(Author $author)
    {
        //TODO Що робити з книгою цього автору?

        $author->delete();
        return response()->json(null, 204);
    }
}
