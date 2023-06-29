<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        $post = new Post();
        return view('user.posts.create', compact('categories', 'post', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required'
        ]);
        $post = Post::create($request->all());
        $post->tags()->sync($request->tags);
        $res = 'Your post will be published soon!';
        return redirect()->back()->with('success', $res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('user.posts.edit', compact('categories', 'post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
        $post->update($request->all());    
        $post->tags()->sync($request->tags);
        $res = 'Your post updated successfully!';
        return redirect()->back()->with('success', $res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
    public function showPosts()
    {
        $posts = Post::orderBy('total_views', 'DESC')->where('published', '!=', 0)->paginate(10);
        return view('posts.index', compact('posts'));
    }
    public function showCategory(Category $category)
    {
        $title = $category->name;
        $posts = Post::with('tags')->where('category_id', '=', $category->id)->where('published', '!=', 0)->paginate(10);
        $tags = Tag::all();
        return view('posts.category', compact('posts', 'title', 'tags', 'category'));
    }
    public function showTag(Tag $tag)
    {
        $title = $tag->name;
        $posts = $tag->posts()->where('published', '!=', 0)->paginate(10);
        $tags = Tag::all();
        return view('posts.tag', compact('posts', 'title', 'tags', 'tag'));
    }
    public function showUsersPosts(User $user)
    {
        $title = $user->name;
        $posts = $user->posts()->where('published', '!=', 0)->paginate(10);
        $tags = Tag::all();
        return view('posts.user', compact('posts', 'title', 'tags', 'user'));
    }
}
