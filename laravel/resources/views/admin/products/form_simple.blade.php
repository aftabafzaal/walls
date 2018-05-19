<div class="form-group">
  {!! Form::label('name') !!}
  {!! Form::text('name', null , array('class' => 'form-control','required') ) !!}
</div>
<div class="form-group">
  {!! Form::label('price') !!}
  {!! Form::text('price', null , array('class' => 'form-control','required') ) !!}
</div>
{!! Form::hidden('simpleProduct',1) !!}
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
</div>