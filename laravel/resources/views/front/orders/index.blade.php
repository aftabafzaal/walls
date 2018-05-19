@extends('front')
@section('content')
<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>




<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-cart1.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>You Orders</h2>
            <h4></h4>
        </div>
    </div>
</section>


<section class="inr-intro-area pt30">
    <div class="container">

        <table id="example" class="table table-area0 table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Patient Name</td>
                    <td>Added</td>
                    <td>Total</td>
                    <td></td>                                    
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><?php echo $orderPrefix; ?>{{$order->id}}</td>
                    <td>{{ $order->firstName. ' '.$order->lastName }}</td>
                    <td>{{ date('d M Y h:i a',strtotime($order->created_at))}}</td>
                    <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}{{ $order->grandTotal}}</td>
                    <td><a href="order/{{$order->id}}">Detail</a></td>                                    
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>
</section>

@endsection