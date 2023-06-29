<div class="form-group">
    {!! Form::label('article_id', 'Article') !!}
    {!! Form::select('article_id', $articles, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3">
    {!! Form::label('comment', 'Comment') !!}
    {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
</div>
{!! Form::submit('Save', ['class'=>'btn outlined-button mt-3']) !!}