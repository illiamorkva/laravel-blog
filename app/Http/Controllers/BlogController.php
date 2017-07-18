<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    protected $limit = 3;

    public function index()
    {
        $posts = Post::with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate($this->limit);
        return view("blog.index",compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view("blog.show", compact('post'));
    }
}
