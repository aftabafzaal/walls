@extends('front')

@section('content')

<?php
$required = 'required';
?>
 

<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/slide1.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Profile</h2>
            <h4></h4>
        </div>
    </div>
</section>

 
 
 
<section class="profile-area pt30">
    <div class="container">	
        <div class="row">  	
            <div class="profile-area col-sm-8 col-sm-offset-2">
                
                <div class="contact-form fom-shad pt10 mb30">
                    
                    @if (count($errors->register) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->register->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (Session::has('success'))
                <div class="alert alert-success">
                    <h4><i class="icon fa fa-check"></i> &nbsp  {!! session('success') !!}</h4>
                </div>
                @endif
                    {!! Form::model($user, ['files' => true,'class' => 'form','url' => ['updateprofile'], 'method' => 'post']) !!}
                    <div class="form-group col-sm-4">
                        {!! Form::label('First Name') !!}
                        {!! Form::text('firstName', null , array('class' => 'form-control',$required) ) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('Last Name') !!}
                        {!! Form::text('lastName', null , array('class' => 'form-control',$required) ) !!}
                    </div>

                    <div class="form-group col-sm-4">
                        {!! Form::label('email') !!}
                        {!! Form::text('email', null , array('class' => 'form-control',$required) ) !!}
                    </div>


                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Confirm">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div> 
    </div>    			
</section>

@endsection