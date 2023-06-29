@extends('layouts.app')

@section('content')
<div class="main-head"><h1 class="title">Results for "{{$searchText}}"</h1></div>
<div class="flex-wrapper">
    <div class="content">
    <form action="get" class="search-posts">
        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
        <input class="search-posts-ajax" type="text" placeholder="Search for posts">
    </form>
        <div class="posts-elems">
            @foreach ($posts as $post)
            <div class="article">
                <h2 class="title"><a href="/post/{{$post->slug}}">{{$post->title}}</a></h2>
                <div class="tags">
                    <a href="/cat/posts/{{$post->category->slug}}">{{$post->category->name}}</a>
                    @foreach ($post->tags as $tag)
                        <a href="/tag/posts/{{$tag->slug}}">{{$tag->name}}</a>
                    @endforeach
                </div>
                <div class="date">{{$post->created_at->format('d.m.y')}}</div>
                <a href="/post/{{$post->slug}}"><img src={{$post->image}} alt={{$post->title}}></a>
                <div class="desc">{!!$post->shortContent!!}</div>
                <div class="article-footer">
                    <a href="/users-posts/{{$post->user->id}}" class="author"><img src={{$post->user->image}} alt=""><div class="name">{{$post->user->name}}</div></a>
                    {{-- <span><i class="fa-regular fa-thumbs-up"></i>{{$post->thanks}}</span> --}}
                    <div class="views"><i class="fa-regular fa-eye"></i><span>{{$post->total_views}}</span></div>
                </div>
            </div>
            @endforeach
        </div>
        {{$posts->links()}}
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