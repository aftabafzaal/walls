<div class="form-group">
   {!! Form::label('name') !!}
		{!! Form::text('name', null , array('class' => 'form-control','required') ) !!}
</div>
<div class="form-group">
   {!! Form::label('price') !!}
		{!! Form::text('price', null , array('class' => 'form-control','required') ) !!}
</div>
{!! Form::hidden('attribute_id',$attribute_id) !!}