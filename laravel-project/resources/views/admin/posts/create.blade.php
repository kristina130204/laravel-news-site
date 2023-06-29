@extends('layouts.admin')

@section('content')
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
{!! Form::model($post, ['url' => '/admin/posts', 'files' => true]) !!}
<div class="form-group hidden">
    {!! Form::label('user_id', 'User') !!}
    {!! Form::text('user_id', Auth::user()->id, ['class'=>'form-control']) !!}
</div>
    @include('admin.posts._form')
{!! Form::close() !!}
@endsection

@section('title', 'Posts')