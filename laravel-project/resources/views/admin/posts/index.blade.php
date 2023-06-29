@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-2 align-items-center title">
    <h1>{{$title}}</h1>
</div>
<table class="table">
{{$posts->links()}}
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Author</th>
            <th>Title</th>
            <th>Content</th>
            <th>Category</th>
            <th>Comments</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
        @foreach ($posts as $post)
            <tbody>
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img src="{{asset($post->image)}}" alt="{{$post->title}}" style="width: 70px"></td>
                    <td>{{$post->user->name}} </td>
                    <td>{{$post->title}} </td>
                    <td>{!!$post->short_content!!}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{count($post->comments)}} comments</td>
                    <td>{{($post->published) === 0 ? "Not published" : "Published"}}</td>
                    <td class="buttons">
                        <a href="/admin/posts/{{$post->id}}/edit" class="btn outlined-button">Update</a>
                        @if (($post->published) === 0)
                        {!! Form::model($post, ['url' => 'admin/posts/'.$post->id, 'method' => 'put']) !!}
                        <div class="form-group hidden">
                            {!! Form::label('published', 'published') !!}
                            {!! Form::text('published', 1, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group hidden">
                            {!! Form::label('user_id', 'user_id') !!}
                            {!! Form::text('user_id', $post->user->id, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group hidden">
                            {!! Form::label('title', 'title') !!}
                            {!! Form::text('title', $post->title, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group mt-3 hidden">
                            {!! Form::label('content', 'content') !!}
                            {!! Form::textarea('content', $post->content, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group mt-3 hidden">
                            {!! Form::label('category_id', 'category_id') !!}
                            {!! Form::text('category_id', $post->category->id, ['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit('Publish', ['class' => 'btn light-button']) !!}
                        {!! Form::close() !!}
                        @endif
                        {!! Form::open(['url' => '/admin/posts/'.$post->id, 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn light-button']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
        @endforeach
</table>
@endsection

@section('title', 'Posts')