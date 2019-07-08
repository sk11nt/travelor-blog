<?php
declare (strict_types=1);


namespace App\Http\Controllers;


use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::with(['category'])->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'body' => 'required']);

        Post::create([
            'title'       => $request->title,
            'body'        => $request->body,
            'category_id' => $request->category_id
        ]);

        flash()->overlay('Post created successfully.');

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        $post = $post->load(['category']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, ['title' => 'required', 'body' => 'required']);

        $post->update([
            'title'       => $request->title,
            'body'        => $request->body,
            'category_id' => $request->category_id
        ]);

        flash()->overlay('Post updated successfully.');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        flash()->overlay('Post deleted successfully.');

        return redirect('/admin/posts');
    }
}
