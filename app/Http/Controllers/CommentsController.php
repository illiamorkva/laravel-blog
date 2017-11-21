<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests\CommentStoreRequest;

class CommentsController extends Controller
{
    public function store(Post $post, CommentStoreRequest $request)
    {
        $post->createComment($request->all());

        return redirect()->back()->with('message', 'Your comment successfully send');
    }
}
