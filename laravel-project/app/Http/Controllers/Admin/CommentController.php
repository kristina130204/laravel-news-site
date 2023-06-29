<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('published', 'ASC')->where('article_id', '!=', NULL)->paginate(10);
        $articles = Article::all()->pluck('title', 'id');
        return view('admin.comments.index', compact('comments', 'articles'));
    }
    public function onPosts()
    {
        $comments = Comment::orderBy('published', 'ASC')->where('post_id', '!=', 0)->paginate(10);
        $posts = Post::all()->pluck('title', 'id');
        // dd($comments);
        return view('admin.comments.on-posts', compact('comments', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all()->pluck('title', 'id');
        $comment = new Comment();
        return view('admin.comments.create', compact('articles', 'comment'));
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
            'user_id' => 'required',
            'comment' => 'required',
        ]);
        $comment = Comment::create($request->all());
        return redirect('/admin/comments');
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
    public function edit(Comment $comment)
    {
        $articles = Article::all()->pluck('title', 'id');
        return view('admin.comments.edit', compact('articles', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'user_id' => 'required',
            'comment' => 'required',
        ]);
        $comment->update($request->all());    
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->replies()->delete();
        $comment->delete();
        return redirect()->back();
    }
}
