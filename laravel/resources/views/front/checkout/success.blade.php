@extends('login_signup')

@section('content')

{!! Form::open(array( 'class' => 'form','url' => 'postOrder', 'name' => 'checkout')) !!}
<section class="checkout-back-area">
    <div class="container">
   	    <div class="checkout-back col-sm-12">
                   
<h3>Your Payment was successful </h3>
<p class="lead">Thank you for your payment.</p>
<p>Your transaction has been completed, and a receipt for your purchase has been emailed to you. You will receive your first issue of the Eurofish magazine when the next issue is relased. As a paying subscriber you will also receive access to our online version for FREE. This will be sent to the email address you provided. We will contact you before your subscription expires to ensure that you receive the magazine without interruption.</p>

<p>If you have any comments or questions please do not hesitate to contact us:</p>

<ul>
	<li>Tel.: +45 333 777 55</li>
	<li>Fax: +45 333 777 56</li>
	<li>info@eurofishmagazine.com</li>
	<li>Thanks again and have a great day.</li>
</ul>
            
            </div>     
      </div>
    </section>
    
   
    
	 {!! Form::close() !!} 
@endsection

