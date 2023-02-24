<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\NewPostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(10);
        return PostsResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewPostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());
        return new PostsResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        abort_unless(auth()->user()->id === $post->user_id, Response::HTTP_FORBIDDEN);
        return new PostsResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        abort_unless(auth()->user()->id === $post->user_id, Response::HTTP_FORBIDDEN);
        $post->update($request->validated());
        return new PostsResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
