@extends('front')
@section('content')
<?php
$currency = Config::get('params.currency');
$orderPrefix = Config::get('params.order_prefix');
?>
<section class="dashboard-area">
    <div class="tab-content">
        <div id="profile" class="tab-pane fade active in">
            <div class="container">
                
                <div class="col-sm-12">
                    <h3>Order Information</h3>

                    <ul class="list-unstyled">
                        <li><strong>Order ID:</strong> <?php echo $orderPrefix; ?>{{$order->id}}</li>
                        <li><strong>Email:</strong> {{$order->email}}</li>
                        <li><strong>Order Status:</strong> {{ ucfirst($order->orderStatus)}}</li>
                        <li><strong>Order Date:</strong> {{ date("d M Y",strtotime($order->orderDate))}}</li>
                        <li><strong>Order Total:</strong> {{ $currency[Config::get('params.currency_default')]['symbol']}} {{ $order->grandTotal}}</li>
                    </ul>

                    <div class="check-left-sect">
                        <h3>Products Information</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>                                 
                                    <th>Product</th>
                                    
                                    <th>Qty</th>
                                    <th>Price</th>
                                    
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sum = 0;
                                $i = 0;
                                //d($orders->products,1);
                                ?>
                                @foreach ($order->products as $product)
                                <?php
                                $rowTotal = $product->price * $product->quantity;
                                $sum += $rowTotal;

                                if ($i == 0) {
                                    //$billingName=$product->billingFirstName.' '.$product->billingLastName;
                                    //$shippingName=$product->shippingFirstName.' '.$product->shippingLastName;
                                }
                                ?>
                                <tr>
                                    <td>
                                
                                        <img class="img-circle pull-left" style="height: 60px;" src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image ?>" alt="<?php echo $product->name; ?>" />
                                            
                                            
                                    
                                        <div class="cart_productname">
                                        <?php echo $product->name; ?>
                                        </div>
</td>

                                    <td><?php echo $product->quantity ?></td>
                                    <td><span>{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $product->price ?></span></td>
                                    
                                    <td><span>{{ $currency[Config::get('params.currency_default')]['symbol']}} {{ $order->grandTotal}}</span></td>

                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
