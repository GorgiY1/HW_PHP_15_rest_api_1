<?php

namespace App\Http\Controllers;

use App\Models\Post as ModelsPost;
use Illuminate\Http\Request;
use App\Post;



class ApiController extends Controller
{
    public function index()
    {
        $posts = ModelsPost::with('comments')->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $post = ModelsPost::create([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        return response()->json($post);
    }

    public function show($id)
    {
        $post = ModelsPost::with('comments')->find($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = ModelsPost::find($id);
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        return response()->json($post);
    }

    public function destroy($id)
    {
        ModelsPost::destroy($id);
        return response()->json(['message' => 'Post deleted']);
    }
}

