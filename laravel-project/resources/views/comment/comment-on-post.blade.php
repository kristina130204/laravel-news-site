{!! Form::model($comment, ['url' => '/newComment', 'files' => true]) !!}
<div class="form-group hidden">
    {!! Form::label('user_id', 'user_id') !!}
    {!! Form::text('user_id', Auth::user()->id ?? '', ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3 hidden">
    {!! Form::label('post_id', 'Post') !!}
    {!! Form::text('post_id', $post->id, ['class'=>'form-control']) !!}
</div>
@if (Auth::user())
    @if (Auth::user()->banned === 1)
        <h2 class="login">You are banned and can not leave a comment</h2>
    @else
        <div class="form-group mt-3">
            {!! Form::label('comment', 'Leave a comment') !!}
            {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
        </div>
        {!! Form::submit('Send', ['class'=>'btn outlined-button mt-3']) !!}
    @endif
@else
    <h2 class="login">Login to leave a comment</h2>
@endif
{!! Form::close() !!}