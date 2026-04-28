<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategoryStoreRequest;
use App\Http\Requests\Backend\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Pest\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::latest()->get();

        return view('admin.blog-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryStoreRequest $request)
    {
        BlogCategory::create([
            'name' => $request->name,
        ]);

        $notification = [
            'status' => 'success',
            'message' => 'Bloc Category added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = BlogCategory::find($id);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request)
    {
        $category = BlogCategory::find($request->id)
            ->update([
                'name' => $request->name
            ]);

        $notification = [
            'status' => 'success',
            'message' => 'Blog Category updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('blog-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
