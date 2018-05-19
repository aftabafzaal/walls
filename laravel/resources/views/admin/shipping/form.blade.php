<div class="col-lg-12">
@if (count($errors->errors) > 0)
    <div class="alert alert-danger">
    	<strong>Whoops!</strong> There were some problems with your input.<br><br>
    	<ul>
    		@foreach ($errors->errors->all() as $error)
    			<li>{{ $error }}</li>
    		@endforeach
    	</ul>
    </div>
@endif
</div>
<div class="form-group">
  {!! Form::label('name') !!}
  {!! Form::text('name', null , array('class' => 'form-control','required') ) !!}
</div>

<div class="form-group">
  {!! Form::label('Price') !!}
  {!! Form::text('price', null , array('class' => 'form-control','required') ) !!} 

<!--
<div class="form-group">
  {!! Form::label('type') !!}
  {!! Form::select('type', array('percent'=>'cash','cash'=>'cash') ) !!}
</div>
-->