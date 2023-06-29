@extends('layouts.app')

@section('content')
<div class="main-head"><h1 class="title">{{$post->title}}</h1></div>
<div class="flex-wrapper">
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
            <div class="article">
                <div class="tags">
                    <a href="/cat/posts/{{$post->category->slug}}">{{$post->category->name}}</a>
                    @foreach ($post->tags as $tag)
                        <a href="/tag/posts/{{$tag->slug}}">{{$tag->name}}</a>
                    @endforeach
                </div>
                <img src={{$post->image}} class="artic-image" alt={{$post->title}}>
                <a href="/users-posts/{{$post->user->id}}" class="author">
                    <img src={{$post->user->image}} alt="">
                    <div class="name">{{$post->user->name}}</div>
                </a>
                <div class="desc">{!!$post->content!!}</div>
                <div class="date">{{$post->created_at->format('d.m.y')}}</div>
                <div class="article-footer">
                    <span><i class="fa-regular fa-comment"></i>{{count($comments)}}</span>
                    <div class="views"><i class="fa-regular fa-eye"></i><span>{{$post->total_views}}</span></div>
                    <div class="share"><i class="fa-regular fa-share-from-square"></i><div class="buttons hidden">{!! $shareButtons !!}</div></div>
            </div>
            <hr>
            @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @include('comment.comment-on-post')
            <hr>
            @if (count($comments) > 0)
            <div class="comments">
                @foreach ($comments as $comm)
                    <div class="comment">
                        <div class="name-date">
                            <a href="/users-posts/{{$comm->user->id}}" class="user">
                                <img class="image" src={{$comm->user->image ?? "/images/no-image.png"}} alt={{$comm->user->name}}>
                                <div class="name">{{$comm->user->name}}</div>
                            </a>
                            <div class="date">{{$comm->created_at->format('d.m.y')}}</div>
                        </div>
                        <div class="comment-content">
                            <div class="text">{{$comm->comment}}</div>
                            {!! Form::model($reply, ['url' => '/newReply', 'class'=>'hidden']) !!}
                            <div class="form-group hidden">
                                {!! Form::label('user_id', 'user_id') !!}
                                {!! Form::text('user_id', Auth::user()->id ?? '', ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group mt-3 hidden">
                                {!! Form::label('comment_id', 'Comment') !!}
                                {!! Form::text('comment_id', $comm->id, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group mt-3">
                                {!! Form::label('reply', 'Leave a reply') !!}
                                {!! Form::text('reply', "", ['class'=>'form-control']) !!}
                            </div>
                            {!! Form::submit('Send', ['class'=>'btn outlined-button mt-3']) !!}
                            {!! Form::close() !!}
                            <div class="reply-flex">
                                <span class="reply-span">{{count($comm->replies)}} repl{{count($comm->replies) === 1 ? 'y' : 'ies'}}</span>
                                @if (Auth::user())
                                    @if (Auth::user()->banned === 1)
                                        <span class="banned-reply">You are banned and can not leave a reply</span>
                                    @else
                                        <span class="leave-reply">Leave a reply</span>
                                    @endif
                                @else
                                    <span class="login">Login to leave a reply</span>
                                @endif
                            </div>
                            @if (count($comm->replies) > 0)
                                <div class="replies hidden">
                                    @foreach ($comm->replies as $reply)
                                    <div class="reply">
                                        <div class="name-date">
                                            <a href="/users-posts/{{$reply->user->id}}" class="user">
                                                <img class="image" src={{$reply->user->image ?? "/images/no-image.png"}} alt={{$comm->user->name}}>
                                                <div class="name">{{$reply->user->name}}</div>
                                            </a>
                                            <div class="date">{{$comm->created_at->format('d.m.y')}}</div>
                                    </div>
                                    <div class="text">{{$reply->reply}}</div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div> 
            @endif
        </div>
        {{$comments->links()}}
    </div>
    <aside class="sidebar-right">
        <div class="recommend">
            <h2 class="title">Posts you may like</h2>
            <ul class="recommend-ul">
                @foreach ($posts as $pos)
                        <li class="recommend-item">
                            <div class="article">
                                <h2 class="title"><a href="/article/{{$pos->slug}}">{{$pos->title}}</a></h2>
                                <a href="/post/{{$pos->slug}}"><img src={{$pos->image}} alt={{$pos->title}}></a>
                                <div class="desc">{!!$pos->shortContent!!}</div>
                                <div class="date">{{$pos->created_at->format('d.m.y')}}</div>
                            </div>
                        </li>
                @endforeach
            </ul>
        </div>
    </aside>
</div>
<div class="chat-container">
    <div class="chat-btn"><i class="fa-regular fa-comments"></i>
    <div class="chat-div hidden">
        <div id="chat">@include('chat.chat')</div>
    </div>
    </div>
</div>
@endsection
