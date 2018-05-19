<?php
$required = "required";
?>
@include('admin/commons/errors')

<div class="form-group">
    {!! Form::label('Parent Category') !!}
    {!! Form::select('parent_id', $categories,null,array('class' => 'form-control','required')) !!}
</div>

<div class="form-group">
    <label>Title</label>
    {!! Form::label('Name') !!}
    {!! Form::text('name', null , array('class' => 'form-control',$required) ) !!}

</div>

<div class="form-group">
    {!! Form::label('teaser') !!}
    {!! Form::textarea('teaser', null, ['size' => '105x3','class' => 'form-control']) !!} 

</div>

<!--
<div class="form-group">
    {!! Form::label('url') !!}
    {!! Form::text('url', null , array('class' => 'form-control',$required) ) !!}
</div>
-->

<div class="form-group">
    {!! Form::label('image') !!}
    {!! Form::file('image', null, 
    array('class'=>'form-control')) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
</div>