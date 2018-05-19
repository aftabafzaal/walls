@extends('front')

@section('content')

<div class="col-lg-9 col-md-9 main text-left">

            <div class="row" style="display: {{{ (isset($wholesaleStatus) && $wholesaleStatus==1)?'block':'none' }}} ;" id="applied_message" >
            	<div class="col-lg-12 col-md-12 col-sm-12">
                	<span class="main-head whole-sale-head">SHIPPING TIMES</span>
                    <div class="green-back">
                    	<span class="thank-u-txt">Thank You Drop Shippers!<br>We Appreciate Doing Business With You Every Day!</span>
                        
                    </div>
                </div>
            </div>
           
          
            <div class="row" id="apply_button" style="display: {{{ (isset($wholesaleStatus) && $wholesaleStatus==1)?'none':'block' }}} ;" >
            	<div class="col-lg-12 col-md-12 col-sm-12">
                	<div class="form-cont">
                    @if($auth_check==1)
                    
                        @if($wholesaleStatus==0)
                            <span class="form-top">
                                Our wholesale area is only available to registered wholesale vendors. Would you like
                                to wholesale our products? <span>Apply to become a vendor</span> and we will send 
                                you information shortly if you are approved.
                            </span>
                            @if($auth_roleid==0)
                            <button id="apply_vendor" style="width: 100%;height: 60px;border-radius: 5px;font-family: 'OpenSans';font-size: 16px;font-weight: bold;background: #97AF01;color: #fff;margin: 50px 0 0;padding-left: 15px;border: 1px solid #d6d6d6;max-width: 100%;" >Apply</button>
                            @endif
                        @elseif($wholesaleStatus==1)
                        @endif
                    @elseif($auth_check==0)
                        <form class="whole-sale-for" method="POST" action="{{ url('postLogin') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="email" name="email" placeholder="Email Address" required />
                            <input type="password" placeholder="Password" name="password" required  />
                            <input type="submit" value="Login">
                            <a href="{{ url('/forgot')}}">Forgot your password?</a>
                        </form>
                    @endif
                      
                    </div>
                      <span style="display: none;"  id="error_message" class="form-top">
                                
                      </span>
                </div>
            </div>
            
          </div>
          
<script>

$( "#apply_vendor" ).click(function() {
var CSRF_TOKEN = "{{ csrf_token() }}";
  $('#error_message').css('display','none');
  $.ajax({
        url: '{{ url("applyVendor") }}',
        type: 'POST',
        data: {_token: CSRF_TOKEN},
        dataType: 'JSON',
        success: function (data) {
           if(data=='1')
           {
                
                $('#applied_message').css('display','block');
                 $('#apply_button').css('display','none');
                
           }
           else
           {
                $('#error_message').css('display','block');
                $('#error_message').html('Some thing went wrong');
                return false;
           }
        }
    });
});
</script>		
  
@endsection