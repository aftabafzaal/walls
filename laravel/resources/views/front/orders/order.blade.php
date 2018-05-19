@extends('front')
@section('content')
<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>

<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-info.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>Order Information</h2>
            <h4></h4>
        </div>
    </div>
</section>



<section class="inr-intro-area pt50">
    <div class="container">

        <div class="col-sm-4 main text-left">
            <div class="fom-shad col-sm-12 list-icon clrlist listview">

                <h3>Order Information</h3>
                <ul>
                    <li><strong>Order ID:</strong> <?php echo $orderPrefix; ?>{{$order->id}}</li>
                    <li><strong>Email:</strong> {{$order->email}}</li>
                    <li><strong>Order Status:</strong> {{ ucfirst($order->orderStatus)}}</li>
                    <li><strong>Order Date:</strong> {{ date("d M Y",strtotime($order->orderDate))}}</li>
                    <li><strong>Order Total:</strong> {{ $currency[Config::get('params.currency_default')]['symbol']}}{{ $order->grandTotal}}</li>
                </ul>
            </div>
        </div>

        <div class="col-sm-4 main text-left">
            <div class="fom-shad  col-sm-12 list-icon clrlist listview">
                <h3 class="head">Patient Information</h3>

                <ul>
                    <li>
                        <strong>Name:</strong> {{$order->patientName}}
                    </li>
                    <li>
                        <strong>Gender:</strong> {{$order->gender}}
                    </li>
                    <li>
                        <strong>Country:</strong> {{$order->country}}
                    </li>
                    <li>
                        <strong>State:</strong> {{$order->state}}
                    </li>
                    <li>
                        <strong>City:</strong> {{$order->city}}
                    </li>
                    <li>
                        <strong>Zip:</strong> {{$order->zip}}
                    </li>
                    <li>
                        <strong>Phone:</strong> {{$order->phone}}
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-4 main text-left">
            <div class="col-sm-12 fom-shad">
                <div class="box-header with-border">
                    <h3 class="box-title">Test Summary</h3>
                </div>



                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $i = 0;
                        ?>
                        @foreach ($order->products as $product)
                        <?php
                        $rowTotal = $product->price * $product->quantity;
                        $sum += $rowTotal;
                        ?>
                        <tr>
                            <td>

                                <?php echo $product->name; ?>
                            </td>
                            <td><span >{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $product->price ?></span></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>
@if(count($results)>0)
<section class="test-bd-area" >
    <div class="container">
        <div class="check-left-sect">
            <div class="col-lg-12 col-md-12 main text-left">
                <div class="box-header with-border">
                    <h3 class="box-title">Results</h3>
                </div>
                
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Result ID</th>
                            <th>Title</th>
                            <th>Remarks</th>
                            <th>Last Email Sent</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td><?php echo $result->id; ?></td>
                            <td><?php echo $result->title; ?></td>
                            <td><?php echo $result->remarks; ?></td>
                            <td><?php echo $result->lastEmail; ?></td>
                            <td><a href="{{url('uploads/orders/results')}}/{{$result->file}}" class="btn-sm btn-info"> View Report</a></td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>    
        </div>    
    </div>
</section>
                @else
                <!--
                <div class="alert alert-danger alert-dismissible">No result uploaded yet.</div>
                -->
                @endif
@endsection