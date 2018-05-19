@extends('front')

@section('content')

<section class="inr-intro-area pt100">
    <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="page__title text-center ">
                <h2><p>Your Order number is <strong>"<?php echo Config("params.order_prefix") . $order_id; ?>"</strong></p></h2>
            </div>                   


         
  {{ @strip_tags($content->body) }}
        </div>
    </div>
</section>

				
				
@endsection