@extends('layouts.admin')

@section('content')
<div class="title d-flex justify-content-between mb-2 align-items-center ">
    <h1>{{$user->name}}</h1>
</div>
<h3>Comments. Total: {{count($user->comments)}}</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Comment</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->comments as $comment)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="/admin/comments/{{$comment->id}}/edit">{{$comment->comment}}</a></td>
                <td>{{$comment->published === 0 ? 'Not published' : 'Published'}}</td>
                <td class="buttons">
                    {!! Form::open(['url' => '/admin/comments/'.$comment->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn light-button']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
<h3>Messages. Total: {{count($user->messages)}}</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Message</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->messages as $message)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$message->message}}</td>
                <td class="buttons">
                    {!! Form::open(['url' => '/admin/message/'.$message->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn light-button']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title', 'User')