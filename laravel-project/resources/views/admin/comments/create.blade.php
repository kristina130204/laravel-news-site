@extends('layouts.admin')

@section('content')
<h1>Add comment</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($comment, ['url' => '/admin/comments', 'files' => true]) !!}
<div class="form-group hidden">
    {!! Form::label('user_id', 'user_id') !!}
    {!! Form::text('user_id', Auth::user()->id, ['class'=>'form-control']) !!}
</div>
    @include('admin.comments._form')
{!! Form::close() !!}
@endsection

@section('title', 'Comments')