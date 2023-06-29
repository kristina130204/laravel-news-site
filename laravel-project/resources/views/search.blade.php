@extends('layouts.app')

@section('content')
<div class="main-head"><h1 class="title">Results for "{{$searchText}}"</h1></div>
<div class="flex-wrapper">
    <div class="content">
            @foreach ($articles as $article)
            <div class="article">
                <h2 class="title"><a href="/article/{{$article->slug}}">{{$article->title}}</a></h2>
                <div class="tags">
                    @foreach ($article->tags as $tag)
                        <a href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
                    @endforeach
                </div>
                <div class="date">{{$article->created_at->format('d.m.y')}}</div>
                <a href="/article/{{$article->slug}}"><img src={{$article->image}} alt={{$article->title}}></a>
                <div class="desc">{!!$article->shortContent!!}</div>
                <div class="article-footer">
                    <a href="/article/{{$article->slug}}"><i class="fa-regular fa-comment"></i>{{count($article->comments)}}</a>
                    <div class="views"><i class="fa-regular fa-eye"></i><span>{{$article->total_views}}</span></div>
                </div>
            </div>
            @endforeach
            {{$articles->links()}}
    </div>
    <aside class="sidebar-right">
        <a href="" class="adv">
            <div class="text">Learn more</div>
            <img src="/images/placeholder-1.png" alt="">
        </a>
        <div id="chat">
            @include('chat.chat')
        </div>
    </aside>
</div>
@endsection
