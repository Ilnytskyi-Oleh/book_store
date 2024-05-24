<?php

namespace App\Http\Controllers\Api\V1\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\UpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Author $author)
    {
        $data = $request->validated();

        $author->update($data);

        return new AuthorResource($author);
    }
}
