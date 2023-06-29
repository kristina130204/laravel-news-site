<div class="form-group hidden">
    {!! Form::label('user_id', 'user_id') !!}
    {!! Form::text('user_id', Auth::user()->id, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('comment_id', 'Comment') !!}
    {!! Form::select('comment_id', $comments, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3">
    {!! Form::label('reply', 'Reply') !!}
    {!! Form::textarea('reply', null, ['class'=>'form-control']) !!}
</div>
{!! Form::submit('Save', ['class'=>'btn outlined-button mt-3']) !!}