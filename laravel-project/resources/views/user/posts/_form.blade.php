<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3 hidden">
  {!! Form::label('user_id', 'User') !!}
  {!! Form::text('user_id', Auth::user()->id ?? '', ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-3">
  {!! Form::label('tags', 'Tags') !!}
  {!! Form::select('tags[]', $tags, null, ['class'=>'form-control multiple','multiple'=>'multiple']) !!}
</div>
<div class="form-group mt-3">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
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
    <img src="{{asset($post->image)}}" alt="" style="width: 70px">
</div>
{!! Form::submit('Save', ['class'=>'btn outlined-button mt-3']) !!}