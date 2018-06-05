<?php
$required="required";
?>
@include('admin/commons/errors')
<div class="form-group">
    {!! Form::label('Area Name') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('City') !!}
    {!! Form::select('city_id', $cities,null,['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Manager') !!}
    {!! Form::select('user_id', $managers,null,['class' => 'form-control']) !!}
</div>