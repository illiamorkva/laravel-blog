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
        $posts = Post::with('author')->latestFirst()->simplePaginate($this->limit);
        return view("blog.index",compact('posts'));
    }
}
