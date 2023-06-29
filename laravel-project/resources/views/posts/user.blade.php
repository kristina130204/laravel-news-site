@extends('layouts.app')

@section('content')
<div class="main-head head-flex"><img src={{$user->image}} alt={{$user->name}}><h1 class="title">{{$title}}'s posts</h1></div>
<div class="flex-wrapper">
    <div class="content">
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
                    <a href="/users-posts/{{$user->id}}" class="author"><img src={{$post->user->image}} alt=""><div class="name">{{$post->user->name}}</div></a>
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