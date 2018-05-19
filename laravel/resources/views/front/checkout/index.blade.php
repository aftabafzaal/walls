@extends('front')
@section('content')
<?php
$currency = Config::get('params.currency');
$required = "required";

list($year, $month, $date) = explode('-', $user->dob);
?>
<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-checkout.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Checkout</h2>
            <h4></h4>
        </div>
    </div>
</section>

{!! Form::open(array( 'class' => 'form','id' => 'form','url' => 'postOrder', 'name' => 'checkout')) !!}
<section class="billing-area pt50">
    <div class="container">
        @if (count($errors->checkout) > 0)
        <span><div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->checkout->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div></span>
        @endif

        <div style="display: none;" class="payment-errors alert alert-danger"></div>


        @if (!isset($user->id))
        <div class="billing__info-bar p20 bdr1">Returning Customer? <a href="{{url('login')}}">Click here to login</a></div>
        @endif

        <div class="address col-sm-6">
            <div class="patient col-sm-12  fom-shad">
                <h3><mark>1</mark> Patient's Information</h3>
                <div class="patient col-sm-12">
                    <input type="checkbox" name="is_different" id="is_different" >
                    Patient information different from my information.
                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('firstName', 'First Name *') !!}</h5>
                    {!! Form::text('firstName', $user->firstName , array('class' => 'form-control','placeholder' => 'First Name *','id' => 'firstName',$required) ) !!}
                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('lastName', 'Last Name *') !!}</h5>
                    {!! Form::text('lastName', $user->lastName , array('class' => 'form-control','placeholder' => 'Last Name *','id' => 'lastName',$required) ) !!}
                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('email', 'Email *') !!}</h5>
                    {!! Form::text('email', $user->email , array('class' => 'form-control','placeholder' => 'Email *','id' => 'email') ) !!}
                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('gender', 'Gender *') !!}</h5>
                    <div class="inline-form">
                        {!! Form::radio('gender', 'm', true) !!}
                        {!! Form::label('Male', 'Male') !!}
                        {!! Form::radio('gender', 'f') !!}
                        {!! Form::label('Female', 'Female') !!}
                    </div>
                </div>

                <div class="form-group col-sm-12 clrhm">
                    <h5>{!! Form::label('dob', 'Date of birth *') !!}</h5>
                    <div class="form-group col-sm-2 clrhm pl0">
                        <h5>{!! Form::label('date') !!}</h5>
                        {!! Form::selectRange('date',1,31,$date,['class' => 'form-control',$required]) !!}
                    </div>

                    <div class="form-group col-sm-4 clrhm">
                        <h5>{!! Form::label('month') !!}</h5>
                        {!! Form::selectMonth('month',$month, ['class' => 'form-control',$required]) !!}
                    </div>
                    <div class="form-group col-sm-3 clrhm">
                        <h5>{!! Form::label('year') !!}</h5>
                        {!! Form::selectRange('year',2016,1930,$year,['class' => 'form-control',$required])!!}
                    </div>

                </div>

                <div class="form-group col-sm-12">
                    <h5>{!! Form::label('Address Line 1 *') !!}</h5>
                    {!! Form::text('address1', $address->address , array('class' => 'form-control','placeholder' => 'Street Address *','id' => 'address1',$required) ) !!}
                </div>

                <div class="form-group col-sm-12">
                    <h5>{!! Form::label('Address Line 2') !!}</h5>
                    {!! Form::text('address2', $address->address2 , array('class' => 'form-control','placeholder' => 'Appartment.Suite (Optional)','id' => 'address2') ) !!}
                </div>
                <div class="form-group col-sm-12 ">
                    <h5>{!! Form::label('Country *') !!}</h5>
                    {!! Form::select('country_id', 
                    $countries, 
                    230, 
                    ['class' => 'form-control',$required]) !!}
                </div>
                <div class="form-group col-sm-6 ">
                    <h5>{!! Form::label('state *') !!}</h5>
                    {!! Form::text('state', $address->state , array('class' => 'form-control','placeholder' => 'State / Region *','id' => 'state',$required) ) !!}

                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('city *') !!}</h5>
                    {!! Form::text('city', $address->city , array('class' => 'form-control','placeholder' => 'Town / City *','id' => 'city',$required) ) !!}
                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('zip *') !!}</h5>
                    {!! Form::text('zip', $address->zip , array('class' => 'form-control','placeholder' => 'Postal Code / Zipcode *','id' => 'zip',$required) ) !!}
                </div>
                <div class="form-group col-sm-6">
                    <h5>{!! Form::label('phone *') !!}</h5>
                    {!! Form::text('phone', $address->phone , array('class' => 'form-control','placeholder' => 'Phone *','id' => 'phone',$required) ) !!}
                </div>


            </div>
        </div>

        <div class="col2 col-sm-6">

            <div class="order-summary col-sm-12  fom-shad mb30">

                <h3><mark>2</mark>  Order Summary</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>LAB TEST</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>

                    {{--*/ $sum = 0 /*--}}
                    @foreach ($cart as $product)
                    {{--*/ $sum = $sum+($product->total_price*$product->quantity)  /*--}}
                    <tr>
                        <td>{{$product->product_name}} ({{$product->quantity}}) </td>
                        <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}{{$product->total_price}}</td>
                    </tr>
                    @endforeach
                    <tr class="h4">
                        <td>Total</td>
                        <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}{{$sum}}</td
                    </tr>
                </table>
            </div>


            <div class="payment-info col-sm-12  fom-shad mb30">
                <h3><mark>3</mark> Payment Information</h3>
                <div class="form-group" id="cc-group">
                    <!--
                    4242424242424242
                    -->
                    {!! Form::label('cc', 'Credit card number:') !!}

                    {!! Form::text('cc',null , [

                    'class'                         => 'form-control',
                    'required'                      => 'required',
                    'data-stripe'                   => 'number',
                    'data-parsley-type'             => 'number',
                    'maxlength'                     => '16',
                    'data-parsley-trigger'          => 'change focusout',
                    'data-parsley-class-handler'    => '#cc-group'

                    ]) !!}

                </div>

                <div class="form-group" id="ccv-group">
                    {!! Form::label('CVC', 'CVC (3 or 4 digit number):') !!}
                    {!! Form::text('cvc', null, ['class'=> 'form-control','required'=> 'required','data-stripe'=> 'cvc','data-parsley-type'=> 'number','data-parsley-trigger'=>'change focusout','maxlength'=> '4','data-parsley-class-handler'=> '#ccv-group']) !!}
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="exp-m-group">
                            {!! Form::label('expMonth', 'Ex. Month') !!}
                            {!! Form::selectMonth('expMonth', 11, ['class'=> 'form-control','required'              => 'required','data-stripe'=> 'exp-month'],'%m') !!}
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group" id="exp-y-group">
                            {!! Form::label('expYear', 'Ex. Year') !!}
                            {!! Form::selectYear('expYear', date('Y'), date('Y') + 10, null, ['class'=>'form-control',$required,'data-stripe'=>'exp-year']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="payment-info col-sm-12 fom-shad mb30">
                <div class="form-group">
                    <h3><mark>4</mark>  Additional Message</h3>
                    {!! Form::textarea('message', null, ['size' => '105x7','class' => 'form-control']) !!} 

                </div>
                @include('front/common/terms')
                <!--
                type="button"
                -->
                <div class="form-group col-sm-12 p0 mb30">
                    <button   id="place_order" class="form-control btn-primary w100">PLACE ORDER</button>
                </div>
            </div>
        </div>

    </div>

</section>
{!! Form::hidden('grandTotal',$sum) !!}
{!! Form::close() !!}  
<script>

    $('#form').submit(function (event) {

        $('.terms-errors').hide();
        $('.payment-errors').hide();


        var term = check_terms_services();
        if (term === false) {
            return false;
        }

        var form = $('#form');
        form.find('#place_order').prop('disabled', true);
        Stripe.card.createToken(form, stripeResponseHandler);

        return false;
    });


    function stripeResponseHandler(status, response) {
        var form = $('#form');
        // alert(response.error.type);
        if (response.id) {
            var token = response.id;
            form.append($('<input type="hidden" name="stripeToken" />').val(token));
            form.get(0).submit();
        } else {
            $('.payment-errors').show();
            $('.payment-errors').text(response.error.message);
            $('.payment-errors').addClass('alert alert-danger');


            var scrollPos = $("#form").offset().top;
            $(window).scrollTop(scrollPos);
            // $('.payment-errors').focus();
            form.find('#place_order').prop('disabled', false);
            return false;

        }

    }

    /*
     $('#form').on('submitted', function () {
     // do anything here...
     });
     */
    $("#is_different").on("change", function () {
        if ($("#is_different").is(':checked')) {

            $("#firstName").val('');
            $("#lastName").val('');
            $("#email").val('');
            $("#address1").val('');
            $("#address2").val('');
            $("#state").val('');
            $("#city").val('');
            $("#zip").val('');
            $("#phone").val('');
        } else
        {
            $("#firstName").val('<?php echo $user->firstName; ?>');
            $("#lastName").val('<?php echo $user->lastName; ?>');
            $("#email").val('<?php echo $user->email; ?>');
            $("#address1").val('<?php echo $address->address; ?>');
            $("#address2").val('<?php echo $address->address2; ?>');
            $("#state").val('<?php echo $address->state; ?>');
            $("#city").val('<?php echo $address->city; ?>');
            $("#zip").val('<?php echo $address->zip; ?>');
            $("#phone").val('<?php echo $address->phone; ?>');
        }

    });
</script>
@endsection