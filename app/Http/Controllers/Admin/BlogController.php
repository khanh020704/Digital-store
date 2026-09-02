<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = \App\Models\Blog::all();
        return view('admin.blog.blog', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.addblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
{
    if (!$request->hasFile('image')) {
        return back()->withErrors(['image' => 'Image is required']);
    }

    $imagePath = $request->file('image')->store('blog', 'public');

    \App\Models\Blog::create([
        'title' => $request->title,
        'image' => $imagePath,
        'description' => $request->description,
        'content' => $request->content,
    ]);

    return redirect()->route('admin.blog.index')
        ->with('success', 'Blog post added successfully.');
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
        $blog = \App\Models\Blog::findOrFail($id);
        return view('admin.blog.editblog', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = \App\Models\Blog::findOrFail($id);

        $blog->update([
            'title' => $request->title,
            'image' => $request->hasFile('image') ? $request->file('image')->store('blog', 'public') : $blog->image,
            'description' => $request->description,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully');
    }
    
    public function delete(string $id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
