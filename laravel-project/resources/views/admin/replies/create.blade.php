@extends('layouts.admin')

@section('content')
<h1>Add reply</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
{!! Form::model($reply, ['url' => '/admin/replies', 'files' => true]) !!}
    @include('admin.replies._form')
{!! Form::close() !!}
@endsection

@section('title', 'Replies')