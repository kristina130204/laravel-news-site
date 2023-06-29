@extends('layouts.admin')

@section('content')
<h1>Edit reply</h1>
{!! Form::model($reply, ['url' => 'admin/replies/'.$reply->id, 'method' => 'put']) !!}
    @include('admin.replies._form')
{!! Form::close() !!}
@endsection

@section('title', 'Replies')