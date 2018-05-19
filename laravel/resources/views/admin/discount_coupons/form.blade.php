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
  {!! Form::label('Description') !!}
  {!! Form::text('description', null , array('class' => 'form-control','required') ) !!}
</div>

<div class="form-group">
  {!! Form::label('Discount') !!} in %
  {!! Form::text('amount', null , array('class' => 'form-control','required') ) !!} 
</div>
<div class="form-group">
  {!! Form::label('Start Date') !!}   
  {!! Form::text('startDate', null , array('class' => 'datepicker form-control','required') ) !!}
</div>
<div class="form-group">
  {!! Form::label('End Date') !!}
  {!! Form::text('endDate', null , array('class' => 'datepicker form-control','required') ) !!} 
</div>

<div class="form-group">
  {!! Form::label('Maximum Use') !!}
  {!! Form::text('maxUse', null , array('class' => 'form-control','required') ) !!} 
</div>

<div class="form-group">
  {!! Form::label('minimum Order Allowed') !!} 
  {!! Form::text('minOrder', null , array('class' => 'form-control') ) !!} 
</div>
<!--
<div class="form-group">
  {!! Form::label('type') !!}
  {!! Form::select('type', array('percent'=>'cash','cash'=>'cash') ) !!}
</div>
-->