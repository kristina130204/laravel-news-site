@extends('layouts.admin')

@section('content')
    <h1>Edit category</h1>
    {!! Form::model($category, ['url' => '/admin/categories/'.$category->id, 'method' => 'put']) !!}
        @include('admin.categories._form')
    {!! Form::close() !!}
@endsection

@section('title', 'Categories')