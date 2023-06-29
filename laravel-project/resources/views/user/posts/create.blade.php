@extends('layouts.user')

@section('content')
@if (Auth::user()->banned === 0)
    <div class="mt-3 mb-3">
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
        <h1>Add post</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
        {!! Form::model($post, ['url' => '/posts', 'files' => true]) !!}
            @include('user.posts._form')
        {!! Form::close() !!}
    </div>
@else
    <div class="banned"><span>You are currently banned and can not leave any posts, comments and messages</span></div>
@endif

@endsection

@section('title', 'Posts')