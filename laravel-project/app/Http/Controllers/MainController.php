<?php

namespace App\Http\Controllers;

use App\Mail\MailableName;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jorenvh\Share\ShareFacade;

class MainController extends Controller
{
    public function index()
    {
        $articlesFromCookie = json_decode($_COOKIE["article"] ?? '');
        $articlesFromCookie = $articlesFromCookie ? $articlesFromCookie : [];
        $articlesHistory = Article::whereIn('id', $articlesFromCookie)->paginate(6);
        $recentArticles = Article::orderBy('created_at', 'DESC')->paginate(6);
        $categories = Category::get();
        $tags = Tag::all();
        $articles = Article::orderBy('total_views', 'DESC')->paginate(5);
        $posts = Post::orderBy('total_views', 'DESC')->where('published', '!=', 0)->paginate(3);
        return view('home', compact('categories', 'articlesHistory', 'recentArticles', 'tags', 'articles', 'posts'));
    }
    public function showCategory(Category $category)
    {
        $title = $category->name;
        $articles = Article::with('tags')->where('category_id', '=', $category->id)->paginate(10);
        $tags = Tag::all();
        return view('category', compact('articles', 'title', 'tags', 'category'));
    }
    public function showTag(Tag $tag)
    {
        $title = $tag->name;
        $articles = $tag->articles()->paginate(10);
        $tags = Tag::all();
        return view('tag', compact('articles', 'title', 'tags', 'tag'));
    }
    public function showArticle(Article $article)
    {
        $article->increment('total_views');
        $articles = Article::where('category_id', '=', $article->category_id)->where('id', '!=', $article->id)->paginate(3);
        $title = $article->title;
        $comments = $article->comments()->where('published', '!=', 0)->paginate(5);
        $comment = new Comment();
        $reply = new Reply();
        $tags = Tag::all();
        $articlesFromCookie = json_decode($_COOKIE["article"] ?? '');
        $articlesFromCookie = $articlesFromCookie ? $articlesFromCookie : [];
        if(!in_array($article->id, $articlesFromCookie))
            array_unshift($articlesFromCookie, $article->id);
        setcookie("article", json_encode($articlesFromCookie), time() + 86400, $path = '/');  /* expire in 24 hours */
        $shareButtons = ShareFacade::page(
            env('APP_URL').'/article/'.$article->slug
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp() 
        ->reddit();
        return view('article', compact('title', 'article', 'articles', 'comments', 'comment', 'reply', 'tags', 'shareButtons'));
    }
    public function showPost(Post $post)
    {
        $post->increment('total_views');
        $posts = Post::where('category_id', '=', $post->category_id)->where('id', '!=', $post->id)->where('published', '!=', 0)->paginate(3);
        $title = $post->title;
        $comments = $post->comments()->where('published', '!=', 0)->paginate(5);
        $comment = new Comment();
        $reply = new Reply();
        $tags = Tag::all();
        $shareButtons = ShareFacade::page(
            env('APP_URL').'/post/'.$post->slug
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp() 
        ->reddit();
        return view('posts.post', compact('title', 'post', 'posts', 'comments', 'comment', 'reply', 'tags', 'shareButtons'));
    }
    public function newComment(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'comment' => 'required',
        ]);
        if(!(Auth::user()->banned)){
            $comment = Comment::create($request->all());
            $res = "Your comment will be published soon!";
        }
        return back()->with('success', $res);
    }
    public function newReply(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'reply' => 'required',
        ]);
        if(!(Auth::user()->banned)){
            $reply = Reply::create($request->all());
        }
        return back();
    }
    public function like(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'article_id' => 'required',
        ]);
        $data = $request->all();
        $user = User::find($data['user_id']);
        $article = Article::find($data['article_id']);
        foreach ($user->articles()->get() as $artic) {
            if($artic->id === $article->id){
                $user->articles()->detach($article);
                return back();
            }
        }
        $user->articles()->syncWithoutDetaching($article);
        return back();
    }
    public function search(Request $request)
    {
        $searchText = $request->q;
        $articles = Article::where('title', 'LIKE', "%$searchText%")->orWhere('content', 'LIKE', "%$searchText%")->paginate(10);
        $articles->appends(['q' => $searchText]);
        return view('search', compact('searchText', 'articles'));
    }
    public function searchAjax(Request $request)
    {
        $searchText = $request->q;
        $articles = Article::where('title', 'LIKE', "%$searchText%")->orWhere('content', 'LIKE', "%$searchText%")->paginate(3);
        return response()->json($articles);
    }
    public function searchPosts(Request $request)
    {
        $searchText = $request->q;
        $posts = Post::where('published', '!=', 0)->where('title', 'LIKE', "%$searchText%")->orWhere('content', 'LIKE', "%$searchText%")->paginate(10);
        $posts->appends(['q' => $searchText]);
        return view('posts.search', compact('searchText', 'posts'));
    }
    public function searchAjaxPosts(Request $request)
    {
        $searchText = $request->q;
        $posts = Post::where('published', '!=', 0)->where('title', 'LIKE', "%$searchText%")->orWhere('content', 'LIKE', "%$searchText%")->paginate(10);
        return response()->json($posts);
    }
}
