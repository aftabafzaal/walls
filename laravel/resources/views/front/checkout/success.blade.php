@extends('front')

@section('content')

<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-thankyou.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Thank you for your Order!</h2>
            <h4></h4>
        </div>
    </div>
</section>

{!! Form::open(array( 'class' => 'form','url' => 'postOrder', 'name' => 'checkout')) !!}
<section class="inr-intro-area ">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="page__title">
                <h2><p>Your Order number is <strong>"<?php echo Config("params.order_prefix") . $id; ?>"</strong></p></h2>
            </div>
			   
				<p>Your lab order will be emailed to you within a 4 hour window of your order, during our hours of operation 8 AM PST to 10 PM PST. Please note if you have scheduled for a MD consult, your results must be complete before communication. We look forward to serving you!</p>
			  
			  <div class="clrlist listview list-icon">
				<ul>
					<li><i class="fa fa-phone"></i> Tel.: +1-800-519-2997</li>
					<li><i class="fa fa-envelope"></i> customerservice@newcenturylabs.com</li>
				</ul>
				
				<h5>Thanks again and have a proactive day.</h5>
				
			   </div>
        </div>
    </div>
</section>
{!! Form::close() !!} 
@endsection

