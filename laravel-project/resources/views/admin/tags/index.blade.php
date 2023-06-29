@extends('layouts.admin')

@section('content')
<div class="title d-flex justify-content-between mb-2 align-items-center ">
    <h1>Tags</h1>
    <a href="/admin/tags/create" class="button-with-plus">Add tag<i class="fa-solid fa-plus"></i></a>
</div>
{{$tags->links()}}
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Articles count</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$tag->name}}</td>
                <td>{{count($tag->articles)}} articles</td>
                <td class="buttons">
                    <a href="/admin/tags/{{$tag->id}}/edit" class="btn outlined-button">Update</a>
                    {!! Form::open(['url' => '/admin/tags/'.$tag->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-dark']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title', 'Tags')