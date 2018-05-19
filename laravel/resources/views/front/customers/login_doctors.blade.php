@extends('login_signup')

@section('content')


<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/old_man.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>PHYSICIAN LOGIN</h2>
            <h4></h4>
        </div>
    </div>
</section>


<section class="billing-area pt30 ">
    <div class="container">
	
        <div class="fom col-sm-6 col-sm-offset-3 bdr-next fom-shad pt20 bdr-next fom-shad">
            @include('front.customers.login')
        </div>
		
		 

    </div>
</section>

@endsection