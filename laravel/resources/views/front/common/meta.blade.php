@section('title')<?php echo $title; ?>@stop
@section('description')<?php echo $description=="" ? Config('params.meta_description') : $description; ?>@stop
@section('keywords')<?php echo $keywords=="" ? Config('params.keywords') : $keywords; ?>@stop