<?php
$required="required";
?>
@include('admin/commons/errors')
<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', null , array('class' => 'form-control',$required) ) !!}
</div>