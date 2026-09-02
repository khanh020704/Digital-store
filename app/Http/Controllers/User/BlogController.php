<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(3);
        return view('frontend.blog.blog', compact('blogs'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        
        $next = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        
        $previous = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        
        $avg = DB::table('rates')->where('id_blog', $id)->avg('rate');
        
        $count = DB::table('rates')->where('id_blog', $id)->count();
        
        $userRate = DB::table('rates')->where('id_blog', $id)->where('id_user', Auth::id())->value('rate');

        $comments = Comment::where('id_blog', $id)->orderBy('created_at', 'desc')->get();

        return view('frontend.blog.blogdetails', compact('blog', 'next', 'previous', 'avg', 'count', 'userRate', 'comments'));
    }

    public function rateAjax(Request $request)
    {
        $data = [
            'id_blog' => $request->id_blog,
            'rate' => $request->rate,
            'id_user' => Auth::id(),
        ];
        DB::table('rates')->updateOrInsert(
            [
                'id_user' => Auth::id(),
                'id_blog' => $request->id_blog,
            ],
            [
                'rate' => $request->rate,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
        $avg = DB::table('rates')
            ->where('id_blog', $request->id_blog)
            ->avg('rate');

        $count = DB::table('rates')
            ->where('id_blog', $request->id_blog)
            ->count();

        return response()->json([
            'success' => true,
            'avg' => round($avg, 1),
            'count' => $count
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
