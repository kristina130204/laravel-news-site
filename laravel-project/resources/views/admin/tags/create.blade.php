@extends('layouts.admin')

@section('content')
<h1>Add tag</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($tag, ['url' => '/admin/tags', 'files' => true]) !!}
    @include('admin.tags._form')
{!! Form::close() !!}
@endsection

@section('title', 'Tags')