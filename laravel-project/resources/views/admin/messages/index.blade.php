@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-2 align-items-center title">
    <h1>Messages</h1>
</div>
<table class="table">
{{$messages->links()}}
    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Message</th>
            <th></th>
        </tr>
    </thead>
        @foreach ($messages as $message)
            <tbody>
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$message->user->name}}</td>
                    <td>{{$message->message}}</td>
                    <td class="buttons">
                        {!! Form::open(['url' => '/admin/message/'.$message->id, 'method' => 'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn light-button']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
        @endforeach
</table>
@endsection

@section('title', 'Messages')