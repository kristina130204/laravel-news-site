<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $articles = Article::all();
        $comments = Comment::all();
        $popularArticles = Article::orderBy('total_views', 'desc')->paginate(6);
        $views = [];
        foreach ($articles as $artic) {
            array_push($views, $artic->total_views);
        }
        return view('admin.dashboard', compact(['categories', 'articles', 'comments', 'views', 'popularArticles']));
    }
}
