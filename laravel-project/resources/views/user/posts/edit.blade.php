@extends('layouts.user')

@section('content')
<div class="mt-3 mb-3">
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <h1>Edit post</h1>
    {!! Form::model($post, ['url' => '/posts/'.$post->id, 'files' => true, 'method' => 'put']) !!}
        @include('user.posts._form')
    {!! Form::close() !!}
</div>
@endsection

@section('title', 'Posts')