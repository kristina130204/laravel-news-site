@extends('layouts.admin')

@section('content')
<h1>Edit article</h1>
{!! Form::model($article, ['url' => '/admin/articles/'.$article->id, 'files' => true, 'method' => 'put']) !!}
    @include('admin.articles._form')
{!! Form::close() !!}
@endsection

@section('title', 'Articles')