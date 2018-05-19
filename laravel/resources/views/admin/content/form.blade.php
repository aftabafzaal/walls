<?php
$required="required";
$languages=Config::get('params.languages');
$types=Config::get('params.contentTypes');
?>
@include('admin/commons/errors')

<!--
<div class="form-group">
    {!! Form::label('language') !!}
    {!! Form::select('language_id', $languages,null,['class' => 'form-control',$required]) !!}
</div>
-->
<div class="form-group">
    {!! Form::label('type') !!}
    {!! Form::select('type', $types,null,['class' => 'form-control',$required]) !!}
</div>

<div class="form-group">
    {!! Form::label('code') !!}
    {!! Form::text('code', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('subject') !!}
    {!! Form::text('subject', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('teaser') !!}
    {!! Form::textarea('teaser', null, ['size' => '105x3','class' => 'form-control',$required]) !!} 
</div>

<div class="form-group">
    {!! Form::label('body') !!}
    {!! Form::textarea('body', null, ['size' => '105x25','class' => 'form-control ckeditor',$required]) !!} 
</div>

<div class="form-group">
    {!! Form::label('url') !!}
    {!! Form::text('url', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('Meta Title') !!}
    {!! Form::text('metaTitle', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('Meta Description') !!}
    {!! Form::textarea('metaDescription', null, ['size' => '105x3','class' => 'form-control',$required]) !!} 
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

