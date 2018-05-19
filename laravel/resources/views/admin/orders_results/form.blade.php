<?php
$required = "required";
?>
@include('admin/commons/errors')
<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('remarks') !!}
    {!! Form::textarea('remarks', null, ['size' => '105x3','class' => 'form-control',$required]) !!} 
</div>

<div class="form-group">
    {!! Form::label('upload pdf file') !!}
    {!! Form::file('file', null,array($required,'class'=>'form-control')) !!}
</div>
<div class="row">
    <div class="col-sm-2">
    <button type="submit" name="save" class="btn btn-primary btn-block btn-flat" value="save">Save</button>
    </div>
    <div class="col-sm-2">
    <button type="submit" name="save" class="btn btn-warning btn-block btn-flat" value="email">Save and Email</button>
    </div>
    <div class="col-sm-2">
        <a href="{{ url('/admin/order')}}/{{$order_id}}" class="btn btn-danger btn-block btn-flat">Cancel</a>
    </div>
</div>