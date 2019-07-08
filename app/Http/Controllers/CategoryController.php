<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::withCount('posts')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
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
        $this->validate($request, ['name' => 'required']);

        Category::create(['name' => $request->name, 'description' => $request->description]);
        flash()->overlay('Category created successfully');

        return redirect('/admin/categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, ['name' => 'required']);

        $category->update($request->all());
        flash()->overlay('Category updated successfully');

        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        flash()->overlay('Category deleted successfully');

        return redirect('/admin/categories');
    }
}
