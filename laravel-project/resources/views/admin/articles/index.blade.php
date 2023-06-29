@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-2 align-items-center title">
    <h1>{{$title}}</h1>
    <a class="button-with-plus" href="/admin/articles/create">Create new article<i class="fa-solid fa-plus"></i></a>
</div>
<table class="table">
    {{$articles->links()}}
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>Comments</th>
            <th></th>
        </tr>
    </thead>
        @foreach ($articles as $article)
            <tbody>
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset($article->image)}}" alt="{{$article->title}}" style="width: 70px"></td>
                    <td>{{$article->title}} </td>
                    <td>{!!$article->short_content!!}</td>
                    <td>{{$article->category->name}}</td>
                    <td>{{count($article->comments)}} comments</td>
                    <td class="buttons">
                        <a href="/admin/articles/{{$article->id}}/edit" class="btn outlined-button">Update</a>
                        {!! Form::open(['url' => '/admin/articles/'.$article->id, 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn light-button']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
        @endforeach
</table>

@endsection

@section('title', 'Articles')