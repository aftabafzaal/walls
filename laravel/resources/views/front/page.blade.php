@extends('front')
<?php
$title = $model->metaTitle;
$description = $model->metaDescription;
$keywords = $model->keywords;
?>
@include('front/common/meta')
@section('content')
<?php echo $model->body;?>
@endsection