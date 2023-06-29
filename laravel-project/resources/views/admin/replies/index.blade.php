@extends('layouts.admin')

@section('content')
<div class="title d-flex justify-content-between mb-2 align-items-center ">
    <h1>Replies</h1>
</div>
{{$replies->links()}}
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Reply</th>
                <th>Comment</th>
                <th>Article (or post)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($replies as $reply)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$reply->user->name}}</td>
                <td>{{$reply->shortReply}}</td>
                <td>{{$reply->comment->shortComment}}</td>
                <td>
                @if ($reply->comment->article !== 0 && $reply->comment->article !== NULL)
                    {{$reply->comment->article->title}}
                @else
                    {{$reply->comment->post->title}}
                @endif
                </td>
                <td class="buttons">
                    {!! Form::open(['url' => '/admin/replies/'.$reply->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-dark']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title', 'Replies')