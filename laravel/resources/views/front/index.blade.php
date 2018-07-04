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
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <span class="pins hidden">
            <span class="pin pin1"><img src="{{ asset('front/images/pin2.png') }}" alt="" /></span>
            <span class="pin pin2"><img src="images/pin1.png" alt="" /></span>

        </span>

        <div class="carousel-inner  bg-cvr" style='background-image:url("{{ asset('front/images/slider-bg.png') }}")'>


            <div class="item active bg-cntr" style="background-image:url('{{ asset('front/images/slide1.jpg') }}');">

                <div class="container">
                    <div class="caro-cap">

                        <h2 class="anime-left">Eid ki khushiyan</h2>
                        <h2 class="anime-left delay1s">Karain double</h2>
                        <img  class="anime-left delay2s" src="{{ asset('front/images/slide-caption.png') }}" />
                        <h2  class="anime-left delay3s">Kay sath!</h2>
                    </div>


                    <div class="slide_bottom bg-cvr anime-up" style="background-image:url('{{asset('front/images/slide-wood.png')}}')">
                        <img class="anime-right delay1s" src="{{ asset('front/images/slide-icecream.png') }}" alt="" />
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


<section class="banner-area bg-cvr" style="background-image:url('{{ asset('front/images/banner-bg.png') }}')">
    <div class="container">
        <span class="pin hidden"><img src="{{ asset('front/images/pin3.png') }}" /></span>
        <img src="{{ asset('front/images/banner.png') }}" alt="" />

    </div>
</section>

<section class="feat-area">
    <div class="container" id="featured_products" >
		<div class="hed">
			<h2>FEATURED PRODUCTS</h2>
		</div>
		
	<div class="clearfix"></div>
			
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod1.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod2.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod3.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod4.jpg') }}" alt="" /> 
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod5.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod6.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod7.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			<div class="prod col-sm-3">
				<div class="prod__inr">
					<div class="prod__img">
						<img src="{{ asset('front/images/prod8.jpg') }}" alt="" />
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			
	</div>
</section>

<section class="popular-area">
    <div class="container" id="popular_products" >
			<div class="hed">
				<h2>POPULAR PRODUCTS</h2>
			</div>
			
			<div class="clearfix"></div>
			
			
			<div class="swiper-container dontfly s1">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="prod">
							<div class="prod__inr">
								<div class="prod__img">
									<img src="{{ asset('front/images/pop1.jpg') }}" alt="" /> 
								</div>
								<div class="prod__cont">
									<a class="btn btn-primary" href="#">BUY</a>
								</div>
							</div>
						</div>
					</div>
				 <div class="swiper-slide">
						<div class="prod">
							<div class="prod__inr">
								<div class="prod__img">
									<img src="{{ asset('front/images/pop2.jpg') }}" alt="" /> 
								</div>
								<div class="prod__cont">
									<a class="btn btn-primary" href="#">BUY</a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="swiper-slide">
						<div class="prod">
							<div class="prod__inr">
								<div class="prod__img">
									<img src="{{ asset('front/images/pop3.jpg') }}" alt="" /> 
								</div>
								<div class="prod__cont">
									<a class="btn btn-primary" href="#">BUY</a>
								</div>
							</div>
						</div>
					</div>	 <div class="swiper-slide">
						<div class="prod">
							<div class="prod__inr">
								<div class="prod__img">
									<img src="{{ asset('front/images/pop2.jpg') }}" alt="" />  
								</div>
								<div class="prod__cont">
									<a class="btn btn-primary" href="#">BUY</a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="swiper-slide">
						<div class="prod">
							<div class="prod__inr">
								<div class="prod__img">
									<img src="{{ asset('front/images/pop3.jpg') }}" alt="" /> 
								</div>
								<div class="prod__cont">
									<a class="btn btn-primary" href="#">BUY</a>
								</div>
							</div>
						</div>
					</div>
				 
				 
				</div> 
 
				
			</div>
			
			<div class="swiper-button-next swiper-button-next1"><i class="fa fa-angle-right"></i></div>
				<div class="swiper-button-prev swiper-button-prev1"><i class="fa fa-angle-left"></i></div>

				
				</div>
</section>


<section class="bundles-area   ">
    <div class="container" id="bundle_products">
	
	<div class="hed lg bg-cvr" style="background-image:url('{{ asset('front/images/bundle-bg.png') }}')">
				<h2>
				
				<span class="fl pin"><img src="{{ asset('front/images/pin2.png') }}" /></span>
				Bundles 
				<span class="fr pin"><img src="{{ asset('front/images/pin1.png') }}" /></span>
				
				</h2>
			</div>
			
			
			<div class="clearfix"></div>
			
			
			
			<div class="prod col-sm-6">
				<div class="prod__inr">
					<span class="prod_tag">PACK OF 4</span>
					<div class="prod__img">
						<img src="{{ asset('front/images/bundle1.png') }}" alt="" />
						<h3>Classic + Almond + Hazelnut + Chocholate Strawberry</h3>
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			<div class="prod col-sm-6">
				<div class="prod__inr">
					<span class="prod_tag">PACK OF 4</span>
					<div class="prod__img">
						<img src="{{ asset('front/images/bundle2.png') }}" alt="" />
						<h3>Classic + Almond + Hazelnut + Chocholate Strawberry</h3>
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="prod col-sm-6">
				<div class="prod__inr">
					<span class="prod_tag">PACK OF 4</span>
					<div class="prod__img">
						<img src="{{ asset('front/images/bundle3.png') }}" alt="" />
						<h3>Classic + Almond + Hazelnut + Chocholate Strawberry</h3>
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
			
			
			<div class="prod col-sm-6">
				<div class="prod__inr">
					<span class="prod_tag">PACK OF 4</span>
					<div class="prod__img">
						<img src="{{ asset('front/images/bundle4.png') }}" alt="" />
						<h3>Classic + Almond + Hazelnut + Chocholate Strawberry</h3>
					</div>
					<div class="prod__cont">
						<a class="btn btn-primary" href="#">BUY</a>
					</div>
				</div>
			</div>
		
		
		</div>
</section>
@endsection