<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkRequest;
use App\Http\Resources\BookmarkResource;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index()
    {
        return BookmarkResource::collection(Bookmark::all());
    }

    public function store(BookmarkRequest $request)
    {
        return new BookmarkResource(Bookmark::create($request->validated()));
    }

    public function show(Bookmark $bookmark)
    {
        return new BookmarkResource($bookmark);
    }

    public function update(BookmarkRequest $request, Bookmark $bookmark)
    {
        $bookmark->update($request->validated());

        return new BookmarkResource($bookmark);
    }

    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();

        return response()->json();
    }
}
