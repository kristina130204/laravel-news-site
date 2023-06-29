@extends('layouts.user')
@section('content')
    <div class="main-head">
        <h1 class="title">User profile</h1>
    </div>
    <div class="flex-wrapper">
        <div class="content">
            <div class="user-content">
                <h2 class="title">
                    Views history
                </h2>
                <h3><a href="/user">Back to the user profile</a></h3>
                <div class="history">
                    <div class="grid-home grid-items-four">
                        @foreach ($articlesHistory as $article)
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
                
            </div>
        </div>
    </div>
@endsection