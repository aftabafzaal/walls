@extends('front')

@section('content')

  <div class="col-lg-9 col-md-9 main text-left">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<span class="main-head whole-sale-head">Contact Us</span>
			<div class="txt-back">
				<span class="descrp">You can reach us any time by email <span class="drkgreen-colo"><a href="mailto:dv@miacarina.com">dv@miacarina.com</a></span>.</br>
				We have office hours 
				<span class="pink-col">Mon-Fri 9am - 5pm PST</span> and can <span class="green-color">call 702-522-0487</span>.
				If we do not answer the phone, we may simply have the machines running and cannot hear the phone.</span>
				<span class="descrp descrp2">We check out email several times a day, and this is the best way to contact us</br> <span class="drkgreen-colo"><a href="mailto:dv@miacarina.com">dv@miacarina.com</a></span></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-7 col-md-7 col-sm-7">
			<ul class="contact-detail">
				<li><span class="mesg-img"><img src="{{ asset('/front/images/message-icon.png') }}" alt="Message"></span><span class="message-txt"><a href="mailto:dv@miacarina.com">dv@miacarina.com</a></span></li>
				<li><span class="mesg-img"><img src="{{ asset('/front/images/phone-icon.jpg') }}" alt="Message"></span><span class="message-txt">702-522-0487</span></li>
				<li><span class="mesg-img"><img src="{{ asset('/front/images/location-icon.jpg') }}" alt="Message"></span><span class="message-txt">MiaCarina.com LLC
				6094 S. Sandhill Rd.
				Suite 300
				Las Vegas, NV 89120</span>
				</li>
			</ul>
		</div>
		<div class="contact__fom col-lg-5 col-md-5 col-sm-5">
			
			<form action="http://pub48.bravenet.com/elist/add.php" method="post" class="contact-frm1">
				<span class="form-head">Join the Mailing List</span>
				
				<span class="form-descrp">Enter your name and email address below</span>
                
				<div class="form-group">
					<input type="text" name="ename" placeholder="Your Name"  />
				</div>
				<div class="form-group">
					<input type="text" id="elistaddress21644727420" name="emailaddress" placeholder="Your Email Adress"  />
				</div>
				<div class="form-group">
					<span style="white-space: nowrap;float: left; color: white;"><input style="border: 0px; height:20px;" type="radio" name="action" value="join" checked="checked" /> Subscribe </span>
                </div>
				<div class="form-group">
                <span style="white-space: nowrap;float: left; color: white;"><input style="border: 0px; height:20px;" type="radio" name="action" value="leave" />Unsubscribe 
                </span>
				</div>
				
                <input style="width: 0px; height: 0px; border: black 0px solid;" type="hidden" name="usernum" value="4070977312" />
                <input style="width: 0px; height: 0px; border: black 0px solid;" type="hidden" name="cpv" value="1" />
				<input type="submit" value="Login">
				<a href="http://www.bravenet.com/webtools/elist/" class="getfreetxt">Get your Free Mailing List</a>
				<a href="http://www.bravenet.com" class="bytxt">by Bravenet.com</a>
			</form>
            
			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<?php
			$required='required';
			?>
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form role="form" method="POST" action="{{ URL::to('contact-send') }}" class="conactfrm">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" placeholder="Name" class="text-wdth" name="name" value="{{ old('name') }}" >
				<input type="email" placeholder="Email" class="text-wdth" name="email" value="{{ old('email') }}" >
				<textarea name="message" required >{{ old('message') }}</textarea>
				<span class="frm-txt">Type the characters below in the order in which they appear:</span>
				<span class="captcha-img"> {!! captcha_img() !!}</span><input value="{{ old('captcha') }}" id="captcha" name="captcha" type="text" >
				<input type="submit" value="Submit">
			</form>
		</div>
	</div>
  </div>	
  
@endsection