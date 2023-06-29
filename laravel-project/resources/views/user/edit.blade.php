@extends('layouts.user')
@section('content')
    <div class="main-head">
        <h1 class="title">Edit profile</h1>
    </div>
        <div class="flex-wrapper">
            <div class="content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($user, ['url' => 'user/'.Auth::user()->id, 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group mt-3">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $user->email, ['class'=>'form-control']) !!}
                </div>
                <div class="input-group mt-3">
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn light-button">
                        <i class="fa fa-picture-o"></i> Choose image
                      </a>
                    </span>
                    {!! Form::text('image', null, ['class'=>'form-control', 'id' => 'thumbnail']) !!}
                    {{-- <input id="thumbnail" class="form-control" type="text" name="image"> --}}
                  </div>
                  <div id="holder" style="margin-top:15px;max-height:100px;">
                    <img src="{{asset($user->image)}}" alt="" style="width: 70px">
                </div>
                    <div class="fl-btns">
                        <a href="/user/" class="btn outlined-button">Cancel</a>
                        {!! Form::submit('Save', ['class'=>'btn light-button mt-3']) !!}
                    </div>
                {!! Form::close() !!}
        </div>
    
@endsection