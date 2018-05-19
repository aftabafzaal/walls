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

                    <div class="form-group col-sm-4 clrhm">
                        <h5>{!! Form::label('gender', 'Gender*') !!}</h5>
                        <div class="inline-form">

                            {!! Form::radio('gender', 'm', true) !!}
                            {!! Form::label('Male', 'Male') !!}
                            {!! Form::radio('gender', 'f') !!}
                            {!! Form::label('Female', 'Female') !!}
                        </div>
                    </div>


                    <div class="form-group col-sm-8">

                        <div class="col-sm-12 pl0">
                            {!! Form::label('dob', 'Date of birth*') !!}
                        </div>

                        <div class="col-sm-3 pl0">
                            {!! Form::selectRange('date',1,31,null,['class' => 'form-control',$required]) !!}
                        </div>
                        <div class="col-sm-5">
                            {!! Form::selectMonth('month',null, ['class' => 'form-control',$required]) !!}
                        </div>

                        <div class="col-sm-4 pr0">
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
                            <option value="{{ $state->code }}"
                                    @if($state->code== $address->state) selected= selected @endif
                                    >{{ $state->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::text('city', isset($address->city) ? $address->city : null , array('placeholder'=>"City *",'class' => 'form-control',$required) ) !!}
                    </div>


                    <div class="form-group col-sm-12">
                        {!! Form::text('address', isset($address->address) ? $address->address : null , array('placeholder'=>"Address *",'class' => 'form-control',$required) ) !!}
                    </div>


                    <div class="form-group col-sm-6">
                        {!! Form::text('zip', isset($address->zip) ? $address->zip : null , array('placeholder'=>"Postal Code / Zipcode *",'class' => 'form-control',$required) ) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::text('phone', isset($address->phone) ? $address->phone : null , array('placeholder'=>"Phone *",'class' => 'form-control',$required) ) !!}
                    </div>
{!! Form::hidden('address_id', isset($address->id) ? $address->id : null ) !!}

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