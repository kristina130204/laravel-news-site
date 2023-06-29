<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3">
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description', null, ['class'=>'form-control']) !!}
</div>
{!! Form::submit('Save', ['class'=>'btn outlined-button mt-3']) !!}