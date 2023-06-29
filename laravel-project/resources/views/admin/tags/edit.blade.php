@extends('layouts.admin')

@section('content')
<h1>Edit tag</h1>
{!! Form::model($tag, ['url' => 'admin/tags/'.$tag->id, 'method' => 'put']) !!}
    @include('admin.tags._form')
{!! Form::close() !!}
@endsection

@section('title', 'Tags')