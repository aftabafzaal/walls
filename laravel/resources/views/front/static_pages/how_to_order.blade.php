@extends('front')

@section('content')



<section class="page-bnr-area bg-full valigner" style="background-image:url('{{ asset('front/images/bnr-how.jpg') }}');">
		<div class="container">
			<div class="bnr__cont valign white text-center col-sm-12 anime-flipInX">
				<h2>DON’T JUST THINK YOU’RE HEALTHY,
				<span>KNOW YOU’RE HEALTHY</span></h2>
				<p>Ordering tests when you need to know made easy</p>
			</div>
		</div>
	</section>

	
	
	<section class="how-step-area pt50 pb50" >
		<div class="container">
	
	
			<div class="step__cont col-sm-5">
					<div class="step__img">
						<img src="{{ asset('front/images/how1.png') }}" alt="" />
					</div>
			</div>
			
			
			<div class="step__cont col-sm-7 valigner anime-left">
				<div class="step_list clrlist listview valign">
					<h3>STEP 1</h3>
					<ul>
						<li>Find your lab test(s) of choice.</li>
						<li>Check out with your credit card.</li>
						<li>Your lab order will be located in your login portal </li>
					</ul>
				</div>
			</div>
	
			
			<div class="clearfix"></div>
	
			
			
			<div class="step__cont col-sm-7 valigner anime-left">
				<div class="step_list clrlist listview valign">
					<h3>STEP 2</h3>
					<ul>
						<li>Print your lab order and take it with you to one of our 2,300 Patient Service Center locations. Walk-ins are always welcome!</li>
					</ul>
				</div>
			</div>
	
	
			<div class="step__cont col-sm-5">
					<div class="step__img">
						<img src="{{ asset('front/images/how2.png') }}" alt="" />
					</div>
			</div>
			
			<div class="clearfix"></div>
	
			
	
			<div class="step__cont col-sm-5">
					<div class="step__img">
						<img src="{{ asset('front/images/how3.png') }}" alt="" />
					</div>
			</div>
	
	
			
			<div class="step__cont col-sm-7 valigner anime-left">
				<div class="step_list clrlist listview valign">
					<h3>STEP 3</h3>
					<ul>
						<li>Your confidential results on average take 24-72 hours and placed in your secure portal. You will be notified once your results are ready by email. You may print your lab results and take it with you to discuss with your doctor if needed.</li>
					</ul>
				</div>
			</div>
	
	<div class="clearfix"></div>
	
			
	
			<div class="step__cont col-sm-7 valigner anime-left">
				<div class="step_list clrlist listview valign">
					<h3>Convenient Ordering</h3>
					<ul>
						<li>Order labs and view results from your desk top or any mobile device.</li>
					</ul>
				</div>
			</div>
			
			<div class="step__cont col-sm-5">
					<div class="step__img">
						<img src="{{ asset('front/images/how4.png') }}" alt="" />
					</div>
			</div>
	
	
	
	
		</div>
	</section>
@endsection