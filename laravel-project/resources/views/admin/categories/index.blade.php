@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between mb-2 align-items-center title">
        <h1>{{$title}}</h1>
        <a class="button-with-plus" href="/admin/categories/create">Create new category<i class="fa-solid fa-plus"></i></a>
    </div>
    <table class="table">
        {{$categories->links()}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Articles</th>
                <th></th>
            </tr>
        </thead>
            @foreach ($categories as $category)
                <tbody>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$category->name}} </td>
                        <td>{{$category->description}}</td>
                        <td>{{count($category->articles)}} articles</td>
                        <td class="buttons">
                            <a href="/admin/categories/{{$category->id}}/edit" class="btn outlined-button">Update</a>
                            {!! Form::open(['url' => '/admin/categories/'.$category->id, 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn light-button']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </tbody>
            @endforeach
    </table>

@endsection

@section('title', 'Categories')