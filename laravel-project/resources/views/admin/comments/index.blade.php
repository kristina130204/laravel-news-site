@extends('layouts.admin')

@section('content')
<div class="title d-flex justify-content-between mb-2 align-items-center ">
    <h1>Comments</h1>
    <a href="/admin/comments-on-posts" class="btn light-button">Go to reader's posts comments</a>
</div>
    <table class="table">
        {{$comments->links()}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Article</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->shortComment}}</td>
                <td>{{$articles[$comment->article_id]}}</td>
                <td>{{($comment->published) === 0 ? "Not published" : "Published"}}</td>
                <td class="buttons">
                    @if (($comment->published) === 0)
                    {!! Form::model($comment, ['url' => 'admin/comments/'.$comment->id, 'method' => 'put']) !!}
                    <div class="form-group hidden">
                        {!! Form::label('published', 'published') !!}
                        {!! Form::text('published', 1, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group hidden">
                        {!! Form::label('user_id', 'user_id') !!}
                        {!! Form::text('user_id', $comment->user->id, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group mt-3 hidden">
                        {!! Form::label('comment', 'Comment') !!}
                        {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Publish', ['class' => 'btn light-button']) !!}
                    {!! Form::close() !!}
                    @endif
                    {!! Form::open(['url' => '/admin/comments/'.$comment->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-dark']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection

@section('title', 'Commments')