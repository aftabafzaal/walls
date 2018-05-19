@extends('front')

@section('content')
<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-password.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Change Password</h2>
            <h4></h4>
        </div>
    </div>
</section>
<section id="form" class="mt30 col-sm-12 p0"><!--form-->
    <div class="container">	
        <div class="row">  	

            <div class="cpass-area col-sm-8 col-sm-offset-2">
                <div class="contact-form fom-shad pt20 mb30">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    {!! Form::open(array( 'class' => 'form','url' => 'postchangepassword', 'method' => 'post')) !!}
                    <div class="form-group col-md-12">
                        {!! Form::password('old_password', ['class'=>'form-control','placeholder'=>'Current Password']) !!}
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::password('password', ['class'=>'form-control','placeholder'=>'New Password']) !!}
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Confirm Password']) !!}
                    </div>                        
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                    </div>
                    {!! Form::close() !!} 
                </div>
            </div>

        </div> 
    </div>    			
</section>

@endsection