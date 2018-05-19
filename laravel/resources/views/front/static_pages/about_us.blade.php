@extends('front')

@section('content')


<section class="page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-about.jpg') }}');">
		<div class="container">
			<div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
				<h2>About us</h2>
				<h3>The very center of healthcare starts at the core</br>
 fundamentals of diagnostic testing.</h3>
			</div>
		</div>
	</section>

	
	
	<section class="about-area pt50 pb50" >
		<div class="container">
		
			<div class="cont">
			
				<p>When information about your body matters most to you, our goal is to help you access it so you can make informed decisions about your health. Our main goal is to help empower individuals with easy access to ordering medical laboratory tests custom tailored to each and everybody’s individual needs. Our mission is to help individuals take better control of their healthcare, ultimately to prevent and treat potential diseases early.</p>

				<p>We believe health and wellness starts by getting to know the real “you” from inside out.</p>
			
			</div>
	
			<div class="clearfix"></div>
			
			
			<div class="about-box col-sm-4 anime-left">
				<div class="about__icon">
					<img src="{{ asset('front/images/about-icon1.png') }}" alt="" />
				</div>
				<div class="about__cont">
					<h3>World class service from start to finish </h3>
					<p>We treat everybody here like a member, but without any membership fees. We strive to be the lowest cost providers online with the highest quality service and fast result times.</p>
				</div>
			</div>
	
	
			<div class="about-box col-sm-4 anime-in">
				<div class="about__icon">
					<img src="{{ asset('front/images/about-icon2.png') }}" alt="" />
				</div>
				<div class="about__cont">
					<h3>Security and privacy </h3>
					<p>Your information from ordering tests to receiving results are kept confidential and secure. We follow extremely strict HIPAA guidelines and your information will never be sold or made public.</p>
				</div>
			</div>
	
	
			<div class="about-box col-sm-4 anime-right">
				<div class="about__icon">
					<img src="{{ asset('front/images/about-icon3.png') }}" alt="" />
				</div>
				<div class="about__cont">
					<h3>Locations</h3>
					<p>We have over 2,300 patient service centers throughout the United States for you to take your lab orders to. Feel free to just show up with your lab order, no appointment necessary.</p>
				</div>
			</div>
	
	
	
		</div>
	</section>
	
	
	
	
	<section class="testlab-area text-center bg-full white p100 valigner" style="background-image:url('{{ asset('front/images/about-bot.jpg') }}');">
		
		<div class="container">
			<div class="valign ">
				<h4><i class="fa fa-quote-left"></i>New Century Labs is powered by Quest Diagnostics, the <br/> world’s most credible and advanced Lab.<i class="fa fa-quote-right"></i></h4>
				
				<div class="inline-btns mt40">
					<div class="lnk-btn inline-block def-btn hover"><a href="{{url('shop')}}">View Tests</a></div>
				</div>
			</div>
		</div>
		
	</section>
@endsection