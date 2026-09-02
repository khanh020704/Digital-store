<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to comment.'], 401);
        }
        $request->validate([
            'cmt' => 'required|string|max:1000',
            'id_blog' => 'required|exists:blog,id',
            'level' => 'nullable|integer',
        ]);
        
        $comment = Comment::create([
            'cmt' => $request->cmt,
            'id_user' => Auth::id(),
            'id_blog' => $request->input('id_blog'),
            'avatar_user' => Auth::user()->avatar,
            'name_user' => Auth::user()->name,
            'level' => $request->level ?? 0,
        ]);
        return response()->json(['success' => 'Comment posted successfully.', 'data' => $comment]);
    }
}
