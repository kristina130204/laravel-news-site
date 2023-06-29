@extends('layouts.user')
@section('content')
    <div class="main-head">
        <h1 class="title">User profile</h1>
    </div>
    <div class="flex-wrapper">
        <div class="content">
            <div class="user-content">
                <h2 class="title">
                    Comments
                </h2>
                <h3><a href="/user">Back to the user profile</a></h3>
                <div class="comments">
                    <div class="comments-box">
                        @foreach ($comments as $comment)
                        <div class="comment-grid">
                            <div class="comm-image">@if ($comment->article_id != NULL || 0)
                                <a href="/article/{{$comment->article->slug}}"><img src={{$comment->article->image}} alt={{$comment->article->title}}></a>
                            </div>
                            <h3 class="title"><a href="/article/{{$comment->article->slug}}">{{$comment->article->title}}</a> <span style="color: #444; font-weight: 300">({{$comment->published === 0 ? 'Not published yet' : 'Published'}})</span></h3>
                            @else
                                <a href="/post/{{$comment->post->slug}}"><img src={{$comment->post->image}} alt=   {{$comment->post->title}}></a>
                            </div>
                            <h3 class="title"><a href="/post/{{$comment->post->slug}}">{{$comment->post->title}}</a> <span style="color: #444; font-weight: 300">({{$comment->published === 0 ? 'Not published yet' : 'Published'}})</span></h3>
                            @endif
                            <div class="comment comm-user">
                                <div class="user-info">
                                    <img src={{$comment->user->image}} class="user-image" alt={{$comment->user->name}}>
                                    <div class="username">{{$comment->user->name}}</div>
                                </div>
                                <div class="text">{{$comment->comment}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection