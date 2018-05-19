@extends('front')

@section('content')

<div class="col-lg-9 col-md-9 main text-left">
            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12">
                	<span class="main-head whole-sale-head">Guest Book</span>
					<?php
			$required='required';
			$required="";
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
			<form role="form" method="POST" action="{{ URL::to('savemessage') }}" class="conactfrm">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" placeholder="Name" class="text-wdth" name="name" value="{{ old('name') }}" >
				<input type="email" placeholder="Email" class="text-wdth" name="email" value="{{ old('email') }}" >
				<textarea placeholder="Comments" name="message" required >{{ old('message') }}</textarea>
				<span class="frm-txt">Type the characters below in the order in which they appear:</span>
				<span class="captcha-img">{!! captcha_img() !!}</span><input type="text" id="captcha" name="captcha" >
				<input style="    width: 324px; background: #97af00;color: #fff;font-family: 'OpenSans';font-size: 16px;text-align: center;padding: 15px 0;display: block;margin: 20px auto;border-radius: 10px;" type="submit" class="send-msg" value="Add a Message">
			</form>
			
                   
                    {!! $messages->setPath('')->appends(Request::except('page'))->render() !!}
                    <?php /* ?><ul class="pagination">
                    	<li><a href="#" class="current">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">....</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                   <?php */?>
                    <ul class="guest-list">
					@foreach ($messages as $message)
                    	<li>
                        	<span class="guest-name"><?php echo $message->name; ?></span>
                            <span class="guest-date"><?php 
							$date = new DateTime($message->created_at);
							echo $date->format('l jS \of F Y');
							
							?></span>
                            <span class="descrp"><?php echo $message->message; ?></span>
                        </li>
                    @endforeach 
                    </ul>
                    {!! $messages->setPath('')->appends(Request::except('page'))->render() !!}
                    <?php /* ?>
                    <ul class="pagination">
                    	<li><a href="#" class="current">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">....</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                    <?php */?>
                </div>
            </div>
            
          </div>
		
  
@endsection