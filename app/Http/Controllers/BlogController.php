<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(20);

        return view('pages.blogs.index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        Auth::authenticate();
        return view('pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Auth::authenticate();

        $request->validate([
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:10',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $blog = new Blog();
        $blog->fill($input)->save();

        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('pages.blogs.show', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        Auth::authenticate();
        return view('pages.blogs.create', [
            'blog' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        Auth::authenticate();
        $request->validate([
            'title' => 'required|string|max:100|min:10',
            'content' => 'required|string|min:10',
        ]);

        $input = $request->all();
        $blog->fill($input)->save();

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Auth::authenticate();
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
