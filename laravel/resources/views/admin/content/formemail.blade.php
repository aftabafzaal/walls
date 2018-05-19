<?php
$required="required";
?>
<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('code') !!}
    {!! Form::text('code', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('subject') !!}
    {!! Form::text('subject', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('body') !!}
    {!! Form::textarea('body', null, ['size' => '105x25','class' => 'form-control ckeditor',$required]) !!} 
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
</div>