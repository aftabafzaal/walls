@extends('front')
<?php
$title = $model->metaTitle;
$description = $model->metaDescription;
$keywords = $model->keywords;
?>
@include('front/common/meta')
@section('content')






<section class="slider-area no-ctrl " >
    <div id="carousel-example-generic" class="carousel slide slider--pauseplay">

        <ol class="carousel-indicators thumbs">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        </ol>

  

        <div class="carousel-inner  bg-cvr p10" style='background-image:url("{{ asset('front/images/slide1.jpg') }}")'>


            <div class="item active bg-cntr" >

                <div class="container">
                    <div class="col-sm-6 cont pt100 white">
						<h1 class="anime-left delay3s">TASTE HAPPINESS NOW</h1>
                    </div>


                    <div class="col-sm-6 bg-cvr anime-up" style="background-image:url('{{asset('front/images/slide-wood.png')}}')">
                        <img class="anime-right delay1s" src="{{ asset('front/images/slide-img.png') }}" alt="" />
                    </div>
                </div>

            </div>

        </div>

        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>

    </div>

</section>

 

<section class="feat-area">
    <div class="container0" id="featured_products" >
  
			
	<div class="metroflip-box prodbox col-sm-4 ">
		<div class="metroflip_inr row  bg-blue ">
			<div class="front w100 prod__img">
				<div class="__img"> 
					<img src="{{ asset('front/images/prod1.png') }}" atl="" />
				</div>
				<div class="__tag"> 
					<img src="{{ asset('front/images/bundle4.png') }}" alt="" />
				</div>
			</div>
			<div class="back  w100 ">
				<a href="#">BUY</a>
			</div>
		</div>
	</div>
 
	<div class="metroflip-box prodbox col-sm-4 ">
		<div class="metroflip_inr row  bg-brown ">
			<div class="front w100 prod__img">
				<div class="__img"> 
					<img src="{{ asset('front/images/prod2.png') }}" atl="" />
				</div>
				<div class="__tag"> 
					<img src="{{ asset('front/images/bundle1.png') }}" alt="" />
				</div>
			</div>
			<div class="back  w100 ">
				<a href="#">BUY</a>
			</div>
		</div>
	</div>


		<div class="metroflip-box prodbox col-sm-4 ">
		<div class="metroflip_inr row  bg-purple">
			<div class="front w100 prod__img">
				<div class="__img"> 
					<img src="{{ asset('front/images/prod3.png') }}" atl="" />
				</div>
				<div class="__tag"> 
					<img src="{{ asset('front/images/bundle3.png') }}" alt="" />
				</div>
			</div>
			<div class="back  w100 ">
				<a href="#">BUY</a>
			</div>
		</div>
	</div>

		<div class="metroflip-box prodbox col-sm-4 ">
		<div class="metroflip_inr row  bg-pink">
			<div class="front w100 prod__img">
				<div class="__img"> 
					<img src="{{ asset('front/images/prod4.png') }}" atl="" />
				</div>
				<div class="__tag"> 
					<img src="{{ asset('front/images/bundle2.png') }}" alt="" />
				</div>
			</div>
			<div class="back  w100 ">
				<a href="#">BUY</a>
			</div>
		</div>
	</div>
	<div class="metroflip-box prodbox col-sm-4 prod--sm">
		<div class="metroflip_inr row  bg-green">
			<div class="front w100 prod__img">
			<h3>BUILD YOUR BASKET</h3>
				<div class="__img"> 
					<img src="{{ asset('front/images/prod5.png') }}" atl="" />
				</div>
				<div class="__tag"> 
					<img src="{{ asset('front/images/bundle2.png') }}" alt="" />
				</div>
			</div>
			<div class="back  w100 ">
				<a href="#">BUY</a>
			</div>
		</div>
	</div>
	<div class="metroflip-box prodbox col-sm-4 prod--sm">
		<div class="metroflip_inr row  bg-yellow">
			<div class="front w100 prod__img">
				<h3>Bundles</h3>
				<div class="__img"> 
					<img src="{{ asset('front/images/prod6.png') }}" atl="" />
				</div>
				<div class="__tag"> 
					<img src="{{ asset('front/images/bundle2.png') }}" alt="" />
				</div>
			</div>
			<div class="back  w100 ">
				<a href="#">BUY</a>
			</div>
		</div>
	</div>

			  
			
	</div>
</section>
  
@endsection