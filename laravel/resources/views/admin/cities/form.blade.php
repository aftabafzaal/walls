<?php
$required="required";
?>
@include('admin/commons/errors')
<div class="form-group">
    {!! Form::label('City Name') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('State') !!}
    {!! Form::select('state_id', $states,null,['class' => 'form-control']) !!}
</div>
