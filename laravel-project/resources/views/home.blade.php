@extends('layouts.home')

@section('content')
<div class="flex-wrapper">
    <div class="content">
        <div class="reacently-posted">
            <h2 class="title title-styled">Recently posted articles</h2>
            <div class="grid-home grid-items-two">
                @foreach ($recentArticles as $article)
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
        @if (count($articlesHistory) > 0)
        <div class="recently-viewed">
        <h2 class="title title-styled">Articles you viewed recently</h2>
        <div class="grid-home grid-items-three">
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
        @endif
        @include('posts.posts-snippet')
        </div>
        <aside class="sidebar-right">
            <a href="" class="adv">
                <div class="text">Learn more</div>
                <img src="/images/placeholder-1.png" alt="">
            </a>
            <div class="recommend">
                <h2 class="title title-styled">5 The Most Popular Articles</h2>
                <ul class="recommend-ul">
                    @foreach ($articles as $artic)
                            <li class="recommend-item">
                                <div class="article">
                                    <h2 class="title"><a href="/article/{{$artic->slug}}">{{$artic->title}}</a></h2>
                                    <a href="/article/{{$artic->slug}}"><img src={{$artic->image}} alt={{$artic->title}}></a>
                                    <div class="desc">{!!$artic->shortContent!!}</div>
                                    <div class="date">{{$artic->created_at->format('d.m.y')}}</div>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>    
    <div class="categories">
        @foreach ($categories as $category)
            <div class="category">
                <h2 class="title title-styled"><a href="/cat/{{$category->slug}}">{{$category->name}}</a></h2>
                <div class="grid-home grid-items-four">
                    @foreach ($category->articles()->paginate(4) as $article)
                        <a href="/article/{{$article->slug}}" class="grid-item">
                            <div class="image-title">
                                <div class="image"><img src={{$article->image}} alt={{$article->title}}><div class="date-views"><div    class="date">{{$article->created_at->format('d.m.y')}}</div><div class="views"><i class="fa-regular fa-eye"></i>{{$article->total_views}}</div></div></div>
                                <h2 class="title">{{$article->title}}</h2>
                            </div>
                            <div class="desc">{!!$article->shortContent!!}</div>
                        </a>
                    @endforeach
                </div>
                </div>
        @endforeach
    </div>
@endsection
