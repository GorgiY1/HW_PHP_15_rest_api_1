<?php

namespace App\Http\Controllers;
use App\Models\Comment as ModelsComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $comment = ModelsComment::create([
            'post_id' => $postId,
            'comment_text' => $request->input('comment_text')
        ]);
        return response()->json($comment);
    }

    public function index($postId)
    {
        $comments = ModelsComment::where('post_id', $postId)->get();
        return response()->json($comments);
    }

    public function update(Request $request, $commentId)
    {
        $comment = ModelsComment::find($commentId);
        $comment->update([
            'comment_text' => $request->input('comment_text')
        ]);
        return response()->json($comment);
    }

    public function destroy($commentId)
    {
        ModelsComment::destroy($commentId);
        return response()->json(['message' => 'Комментарий удален']);
    }
}

