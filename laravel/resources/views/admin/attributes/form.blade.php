<div class="form-group">
  {!! Form::label('name') !!}
  {!! Form::text('name', null , array('class' => 'form-control','required') ) !!}
</div>
<div class="form-group">
  {!! Form::label('Code') !!}
  {!! Form::text('code', null , array('class' => 'form-control','required') ) !!}
</div>
<div class="form-group">
  {!! Form::label('type') !!}
  {!! Form::select('type', array('textfield'=>'Text Field','dropdown'=>'Drop Down (Select))') ) !!}
</div>