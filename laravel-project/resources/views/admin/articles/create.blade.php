@extends('layouts.admin')

@section('content')
    <h1>Add article</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($article, ['url' => '/admin/articles', 'files' => true]) !!}
    @include('admin.articles._form')
{!! Form::close() !!}
@endsection

@section('title', 'Articles')