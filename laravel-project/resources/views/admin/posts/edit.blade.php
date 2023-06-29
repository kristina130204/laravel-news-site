@extends('layouts.admin')

@section('content')
<h1>Edit post</h1>
{!! Form::model($post, ['url' => '/admin/posts/'.$post->id, 'files' => true, 'method' => 'put']) !!}
<div class="form-group hidden">
    {!! Form::label('user_id', 'User') !!}
    {!! Form::text('user_id', $post->user->id, ['class'=>'form-control']) !!}
</div>
    @include('admin.posts._form')
{!! Form::close() !!}
@endsection

@section('title', 'Posts')