<?php
$currency = Config::get('params.currency');
$order_email = Config('params.order_email');
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <h1 style="display:inline; color:#333; margin-top:40px;margin-bottom:40px; padding:3px 0px; text-transform:uppercase; font-weight:300;">New Order Placed!</h1>
            <p style="margin-bottom:0px;">Hi {{ $order_email }},</p>           
            <p><strong>{{$orders->name}}</strong> has made an order at Hammer Fit.</p> 
            <p>Order ID: <span>{{ $orders->id }}</span></p>
            <p>Shipping Address: <span>{{$addresses->address}} {{$addresses->address2}}</span></p>
            <p>Country: <span>{{$addresses->country}}</span></p>
            <p>State: <span>{{$addresses->state}}</span></p>
            <p>City: <span>{{$addresses->city}}</span></p>
            <p>Zip: <span>{{$addresses->zip}}</span></p>
            <p>Phone: <span>{{$addresses->phone}}</span></p>
        </div>
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <table>
                <thead>
                    <tr>                                 
                        <th>Product</th>
                        <th>Attribute</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Shipping</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sum = 0;
                    $i = 0;
                    //d($orders->products,1);
                    ?>
                    @foreach ($orders->products as $product)
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
                           

                                <img style="height: 60px;" src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image ?>" alt="<?php echo $product->name; ?>" />


                            <div class="cart_productname">
                                <?php echo $product->name; ?>
                            </div>
                        </td>
                        <td>
                            <?php
                            $attributes = explode(',', $product->attribute);
                            $values = explode(',', $product->value);
                            while (list($key, $attribute) = each($attributes) and list($key, $value) = each($values)) {
                                if ($value == '--' || $value == '')
                                    continue;
                                ?>
                                <div class="cart_attribute_name">
                                    <p ><?php echo $attribute; ?> : <?php echo $value ?></p>
                                </div>
                                <?php
                                $i++;
                            }
                            ?>

                        </td>
                        <td><?php echo $product->quantity ?></td>
                        <td><span>{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $product->price ?></span></td>
                        <td><span>{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $orders->shippingPrice; ?></span></td>
                        <td><span>{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $orders->grandTotal; ?></span></td>

                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </body>
</html>