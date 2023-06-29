@extends('layouts.admin')

@section('content')
<h1>Edit comment</h1>
{!! Form::model($comment, ['url' => 'admin/comments/'.$comment->id, 'method' => 'put']) !!}
<div class="form-group hidden">
    {!! Form::label('user_id', 'user_id') !!}
    {!! Form::text('user_id', $comment->user->id, ['class'=>'form-control']) !!}
</div>
    @include('admin.comments._form')
{!! Form::close() !!}
@endsection

@section('title', 'Comments')