@extends('front')

@section('content')
<?php
$passwordPattern = Config::get('params.password_pattern');
$required = 'required';
$required = '';
?>

<section class="bnr-area page-bnr-area bg-full bg-cntr valigner">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>SIGN UP</h2>
            
        </div>
    </div>
</section>

{!! Form::open(array( 'class' => 'form','url' => 'signUpPost', 'name' => 'register')) !!}
<section class="billing-area ">
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

        @if (Session::has('success'))
        <div class="alert alert-success">
            <h4><i class="icon fa fa-check"></i> &nbsp  {!! session('success') !!}</h4>
        </div>
        @endif

        <div class="fom fom-shad pt20 col-sm-9 p0 pul-cntr">

            <div class="form-group col-sm-6">  
                {!! Form::text('firstName', Request::input('firstName') , array('placeholder'=>"First Name *",'class' => 'form-control',$required) ) !!}
            </div>
            <div class="form-group col-sm-6">  
                {!! Form::text('lastName', null , array('placeholder'=>"Last Name *",'class' => 'form-control',$required) ) !!}
            </div>

            <div class="form-group col-sm-12">
                {!! Form::text('email', null , array('placeholder'=>"Email *",'class' => 'form-control',$required) ) !!}
            </div>

            <div class="form-group col-sm-12">
                {!! Form::password('password', array('placeholder'=>"Password *",'class' => 'form-control','pattern' => $passwordPattern,$required) ) !!}

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

            <div class="form-group col-sm-12">
                {!! Form::text('country', null , array('placeholder'=>"Pakistan (PK)",'class' => 'form-control','readonly' => 'readonly',$required) ) !!}
            </div>

            <div class="form-group col-sm-4">
                <select name="state" id="state" data-option="city" <?php echo $required; ?> class="form-control state">
                    <option >State *</option>
                    @foreach ($states as $state)
                    <option value="{{ $state->code }}">{{ $state->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-4">
                <select name="city" id="city" data-option="area" <?php echo $required; ?> class="form-control city">
                    
                </select>
            </div>
            <div class="form-group col-sm-4">
                <select name="area" id="area" <?php echo $required; ?> class="form-control">
                </select>
            </div>

            <div class="form-group col-sm-12">
                {!! Form::text('address', null , array('placeholder'=>"Complete Address *",'class' => 'form-control',$required) ) !!}
            </div>
            
            <div class="form-group col-sm-6">
                {!! Form::text('phone', null , array('placeholder'=>"Phone",'class' => 'form-control',$required) ) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::text('mobile', null , array('placeholder'=>"Mobile *",'class' => 'form-control',$required) ) !!}
            </div>
            <div class="form-group col-sm-6">  
                <?php
                ///echo Recaptcha::render(['lang' => 'en']);
                ?>
            </div>
            <div class="form-group col-sm-6 text-right">
                <button type="submit" class="btn btn-flat btn-primary " >SIGNUP</button>
            </div>

            {!! Form::hidden('role_id',2) !!}
        </div>
    </div>
</section>
{!! Form::close() !!}

@endsection