<?php
$required = "required";
?>
@include('admin/commons/errors')
<div class="form-group">
    {!! Form::label('name') !!}
    {!! Form::text('name', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('code') !!}
    {!! Form::text('sku', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('key') !!}
    {!! Form::text('key', $key , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('Short Description') !!}
    {!! Form::text('teaser', null , array('class' => 'form-control') ) !!}
</div>

<div class="form-group">
    {!! Form::label('description') !!}
    {!! Form::textarea('description', null, ['size' => '105x3','class' => 'form-control ckeditor',$required]) !!} 
</div>


<div class="form-group">
    {!! Form::label('price') !!}
    {!! Form::text('price', null , array('class' => 'form-control',$required) ) !!}
</div>


<div class="form-group">
    {!! Form::checkbox('sale',1,false,['id'=>'sale']); !!}
    Sale This Product. 
</div>

<div class="form-group">
    {!! Form::label('Sale Price') !!}
    {!! Form::text('salePrice', null , array('class' => 'form-control') ) !!}
</div>

<div class="form-group">
    {!! Form::label('keywords') !!}
    {!! Form::text('keywords', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('image') !!}
    {!! Form::file('image', null,array($required,'class'=>'form-control')) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
</div>