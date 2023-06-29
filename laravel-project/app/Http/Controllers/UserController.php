<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articlesFromCookie = json_decode($_COOKIE["article"] ?? '');
        $articlesFromCookie = $articlesFromCookie ? $articlesFromCookie : [];
        $articlesHistory = Article::whereIn('id', $articlesFromCookie)->paginate(4);
        $comments = Comment::where('user_id', Auth::user()->id)->paginate(2);
        return view('user.index', compact('articlesHistory', 'comments'));
    }
    public function history()
    {
        $articlesFromCookie = json_decode($_COOKIE["article"] ?? '');
        $articlesFromCookie = $articlesFromCookie ? $articlesFromCookie : [];
        $articlesHistory = Article::whereIn('id', $articlesFromCookie)->get();
        return view('user.history', compact('articlesHistory'));
    }
    public function likes()
    {
        return view('user.likes');
    }
    public function comments()
    {
        $comments = Comment::where('user_id', Auth::user()->id)->get();
        return view('user.comments', compact('comments'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->update($request->all());    
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->comments()->delete();
        $user->delete();
        return redirect()->back();
    }
    public function showPosts()
    {
        $posts = Post::with('tags')->where('user_id', '=', Auth::user()->id)->paginate(10);
        $tags = Tag::all();
        return view('user.posts.index', compact('posts', 'tags'));
    }
}
