@extends('login_signup')

@section('content')


<section class="inr-bnr-blank">
    <div class="container">
        <div class="hed"><h2>LOGIN</h2></div>
    </div>
</section>




<section class="inr-intro-area ">
    <div class="container">
 
        <div class="fom col-sm-6 fom-shad pt20">
            @include('front.customers.login')
                    <a href="{{ url('forgot') }}" class="link pul-lft">
            <i class="fa fa-support"></i>Lost your passward?
        </a>
        </div>
        <div class="cont text-center col-sm-6 pl50 pr50">
            <h2>REGISTER</h2>
            <p>Registering allows you to order tests. Just fill in the fields and we’ll get you ready to go in no time. We will only ask you for information that allows us to prepare your lab order.</p>
            <div class="lnk-btn "><a href="{{ url('register')}}">REGISTER</a></div>
        </div>
    </div>
</section>
@endsection