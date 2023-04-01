<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;

class TopicController extends Controller
{
    public function index()
    {
        return TopicResource::collection(Topic::all());
    }

    public function store(TopicRequest $request)
    {
        return new TopicResource(Topic::create($request->validated()));
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $topic->update($request->validated());

        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return response()->json();
    }
}
