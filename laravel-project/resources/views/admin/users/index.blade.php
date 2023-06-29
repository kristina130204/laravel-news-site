@extends('layouts.admin')

@section('content')
<div class="title d-flex justify-content-between mb-2 align-items-center ">
    <h1>Users</h1>
    <a href="/admin/blacklist" class="btn outlined-button">View blacklist</a>
</div>
    <table class="table">
        {{$users->links()}}
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Comments</th>
                <th>Messages</th>
                <th>Posts</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><a href="/admin/users/{{$user->id}}">{{$user->name}}</a></td>
                <td>{{count($user->comments)}}</td>
                <td>{{count($user->messages)}}</td>
                <td>{{count($user->posts)}}</td>
                <td>{{$user->banned ? "Banned" : "Not banned"}}</td>
                <td class="buttons">
                    {!! Form::open(['url' => '/user/'.$user->id, 'method' => 'DELETE']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-dark']) !!}
                    {!! Form::close() !!}
                    @if (!($user->banned))
                    {!! Form::open(['url' => '/admin/users/'.$user->id, 'method' => 'put', 'files' => true]) !!}
                    <div class="form-group hidden">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group hidden mt-3">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', $user->email, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group hidden">
                        {!! Form::label('banned', 'Banned') !!}
                        {!! Form::text('banned', 1, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Ban', ['class' => 'btn light-button']) !!}
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title', 'Users')