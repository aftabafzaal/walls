@extends('login_signup')

@section('content')
<?php
$passwordPattern = Config::get('params.password_pattern');
$required = 'required';
?>

<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/old_man.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>SIGNUP</h2>
            <h4></h4>
			
        </div>
    </div>
</section> 



<section class="billing-area pt30 pb30">
    <div class="container">
	
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
		
		
        {!! Form::open(array( 'class' => 'form','url' => 'signUpPost', 'name' => 'register')) !!}
        <section class="billing-area pt30 pb30">
            <div class="container">

                <div class="form-group col-sm-6">  
                    {!! Form::text('firstName', Request::input('firstName') , array('placeholder'=>"First Name *",'class' => 'form-control',$required) ) !!}
                </div>
                <div class="form-group col-sm-6">  
                    {!! Form::text('lastName', null , array('placeholder'=>"Last Name *",'class' => 'form-control',$required) ) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::text('email', null , array('placeholder'=>"Email *",'class' => 'form-control',$required) ) !!}
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::password('password', array('placeholder'=>"Password *",'class' => 'form-control',$required) ) !!}
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::password('password_confirmation', array(

                    'data-match-error'=>"Whoops, these don't match",
                    'placeholder'=>"Confirm Password *",
                    "data-match"=>"#password",
                    'class' => 'form-control',$required))
                    !!}
                </div>

                <div class="form-group col-sm-12">
                    <div class="alert alert-info">
                        Your password must contain minimum 8 characters, at least 1 uppercase alphabet, 1 lowercase alphabet, 1 number and 1 special character.
                    </div> 
                </div>

                <div class="form-group col-sm-6 clrhm">
                    <h5>{!! Form::label('gender', 'Gender*') !!}</h5>
                    <div class="inline-form">
                        {!! Form::radio('gender', 'm', true) !!}
                        {!! Form::label('Male', 'Male') !!}
                        {!! Form::radio('gender', 'f') !!}
                        {!! Form::label('Female', 'Female') !!}
                    </div>
                </div>

                <div class="form-group col-sm-6 clrhm">
                    <h5>{!! Form::label('gender', 'Date of birth*') !!}</h5>
                    <div class="form-group col-sm-3  pl0">
                        {!! Form::selectRange('date',1,31,null,['class' => 'form-control',$required]) !!}
                    </div>

                    <div class="form-group col-sm-5">
                        {!! Form::selectMonth('month',null, ['class' => 'form-control',$required]) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::selectRange('year',2016,1930,null,['class' => 'form-control',$required])!!}
                    </div>

                </div>
                <div class="form-group col-sm-12">
                    {!! Form::text('country', null , array('placeholder'=>"Country United States (US)",'class' => 'form-control','readonly' => 'readonly',$required) ) !!}
                </div>
                <div class="form-group col-sm-6">
                    <select name="state" id="state" <?php echo $required; ?> class="form-control">
                        <option >State *</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->code }}">{{ $state->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::text('city', null , array('placeholder'=>"City *",'class' => 'form-control',$required) ) !!}
                </div>


                <div class="form-group col-sm-12">
                    {!! Form::text('address', null , array('placeholder'=>"Address *",'class' => 'form-control',$required) ) !!}
                </div>


                <div class="form-group col-sm-6">
                    {!! Form::text('zip', null , array('placeholder'=>"Postal Code / Zipcode *",'class' => 'form-control',$required) ) !!}
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::text('phone', null , array('placeholder'=>"Phone *",'class' => 'form-control',$required) ) !!}
                </div>
                <div class="form-group col-sm-12">  
                    <?php
                    echo Recaptcha::render(['lang' => 'en']);
                    ?>
                </div>
                <div class="form-group col-sm-12">
                        <small>We do not support orders from the following states:
                            <strong>NY, NJ RI, MD, HI</strong></small>
                    </div>

                {!! Form::hidden('role_id',3) !!}
                <div class="form-group col-sm-12 text-right">
                    <button type="submit" class="btn btn-flat btn-primary " >SIGNUP</button>
                </div>
            </div>
        </section>
        {!! Form::close() !!}
    </div>
</section>

@endsection