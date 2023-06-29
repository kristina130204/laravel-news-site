@extends('layouts.admin')

@section('content')
    <h1>{{$title}}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($category, ['url' => '/admin/categories', 'files' => true]) !!}
        @include('admin.categories._form')
    {!! Form::close() !!}
@endsection

@section('title', 'Categories')