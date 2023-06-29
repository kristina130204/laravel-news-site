@extends('layouts.user')
@section('content')
    <div class="main-head">
        <h1 class="title">User profile</h1>
    </div>
    <div class="flex-wrapper">
        <div class="content">
            <div class="user-content">
                @if (count(Auth::user()->articles()->get()) === 0 && count($comments) === 0)
                    <h2 class="title">Hi! It's your personal account's page. Here you can see all articles that you liked, your comments and blog.</h2>
                @else
                @if(count(Auth::user()->articles()->get()) > 0)
                <h2 class="title">
                    <a href="/likes">Articles you liked</a>
                </h2>
                <div class="likes">
                    <div class="grid-home grid-items-three">
                        @foreach (Auth::user()->articles()->paginate(6) as $article)
                        <a href="/article/{{$article->slug}}" class="grid-item">
                            <div class="image-title">
                                <div class="image"><img src={{$article->image}} alt={{$article->title}}><div class="date-views"><div class="date">{{$article->created_at->format('d.m.y')}}</div><div class="views"><i class="fa-regular fa-eye"></i>{{$article->total_views}}</div></div></div>
                                <h2 class="title">{{$article->title}}</h2>
                            </div>
                            <div class="desc">{!!$article->shortContent!!}</div>
                        </a>
                        @endforeach
                    </div>
                </div>  
                @endif
                @if (count($comments) > 0)
                    <div class="comments">
                    <a href="/user-comments">
                        <h2 class="title">Your comments</h2>
                    </a>
                    <div class="comments-box">
                        @foreach ($comments as $comment)
                        @if ($comment->article === NULL || $comment->article === 0)
                        <div class="comment-grid">
                            <div class="comm-image"><a href="/post/{{$comment->post->slug}}"><img src={{$comment->post->image}} alt={{$comment->post->title}}></a></div>
                            <h3 class="title"><a href="/post/{{$comment->post->slug}}">{{$comment->post->title}}</a></h3>
                            <div class="comment comm-user">
                                <div class="user-info">
                                    <img src={{$comment->user->image}} class="user-image" alt={{$comment->user->name}}>
                                    <div class="username">{{$comment->user->name}}</div>
                                </div>
                                <div class="text">{{$comment->comment}}</div>
                            </div>
                        </div>
                        @else
                            <div class="comment-grid">
                            <div class="comm-image"><a href="/article/{{$comment->article->slug}}"><img src={{$comment->article->image}} alt={{$comment->article->title}}></a></div>
                            <h3 class="title"><a href="/article/{{$comment->article->slug}}">{{$comment->article->title}}</a></h3>
                            <div class="comment comm-user">
                                <div class="user-info">
                                    <img src={{$comment->user->image}} class="user-image" alt={{$comment->user->name}}>
                                    <div class="username">{{$comment->user->name}}</div>
                                </div>
                                <div class="text">{{$comment->comment}}</div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
            </div>
        </div>
        <div class="sidebar-right">
            <div class="history">
                <h2 class="title"><a href="/history">Views history</a></h2>
                <ul class="history-list">
                    @foreach ($articlesHistory as $article)
                        <li class="history-item">
                            <div class="article">
                                <h2 class="title"><a href="/article/{{$article->slug}}">{{$article->title}}</a></h2>
                                <a href="/article/{{$article->slug}}"><img src={{$article->image}} alt={{$article->title}}></a>
                                <div class="desc">{!!$article->shortContent!!}</div>
                                <div class="date">{{$article->created_at->format('d.m.y')}}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection