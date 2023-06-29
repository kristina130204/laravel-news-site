@extends('layouts.user')

@section('content')
<div class="main-head"><h1 class="title">{{Auth::user()->name}}'s posts</h1></div>
<div class="flex-wrapper">
    <div class="content">
        @if (count($posts) === 0)
            <h2>You have no posts yet</h2>
            <a href="posts/create" class="btn outlined-button">Create a new post!</a>
        @endif
        <div class="posts-elems">
            @foreach ($posts as $post)
            <div class="article">
                <h2 class="title title-user"><a href="/post/{{$post->slug}}">{{$post->title}}</a><a href="/posts/{{$post->id}}/edit" class="btn edit-button"><i class="fa-solid fa-pen"></i></a></h2>
                <div class="status">{{$post->published === 0 ? 'Not published yet' : 'Published'}}</div>
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
                    <a href="/users-posts/{{Auth::user()->id}}" class="author"><img src={{$post->user->image}} alt=""><div class="name">{{$post->user->name}}</div></a>
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

    </aside>
</div>
@endsection

@section('title', 'Posts')