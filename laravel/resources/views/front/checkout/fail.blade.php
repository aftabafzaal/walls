@extends('front')

@section('content')

<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" >
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2 style="color:#000;">Sorry! Something went wrong.</h2>
        </div>
    </div>
</section>

{!! Form::open(array( 'class' => 'form','url' => 'postOrder', 'name' => 'checkout')) !!}
<section class="inr-intro-area ">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12">
				<p>We are sorry, but your current payment method could not be processed. Please contact your financial institution or Try a different payment method. We reserved your items for you for the next few minutes and look forward to you receiving them soon.</p>
			  
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

