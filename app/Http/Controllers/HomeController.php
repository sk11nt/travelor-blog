<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::with(['category'])->orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('home', compact('posts', 'categories'));
    }
}
