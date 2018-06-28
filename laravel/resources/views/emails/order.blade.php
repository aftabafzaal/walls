{{--*/ $currency=Config::get('params.currency') /*--}}



<div class="col-lg-12 col-md-12">
<h2>Order Information</h2>
<div class="row">
    <div class="col-lg-6 col-md-6 col-md-6">
        <ul>
            <li>Order ID: {{$orders->id}}</li>
            <li>Email: {{$orders->email}}</li>
            <li>Order Date: {{ date("d M Y",strtotime($orders->orderDate))}}</li>
            <li>Order Total: {{ $currency[Config::get('params.currency_default')]['symbol']}} {{ $orders->grandTotal}}</li>
        </ul>
    </div>
</div>
<div class="row">
          
        @foreach($addresses as $address)
        
        <div class="col-lg-6 col-md-6 col-md-6">
            @if($address->addressType=='billing')
            <h3 class="head">Billing Information</h3>
            {{--*/ $name=$orders->billingName /*--}}
            @else
            <h3 class="head">Shipping Information</h3>
            {{--*/ $name=$orders->shippingName /*--}}
            @endif
            <ul>
            <li>
                Name: {{$name}}
            </li>
            <li>
                Country: {{$address->country}}
            </li>
            <li>
                State: {{$address->state}}
            </li>
            <li>
                City: {{$address->city}}
            </li>
            <li>
                Zip: {{$address->zip}}
            </li>
            <li>
                Phone: {{$address->phone}}
            </li>
            </ul>
        
        </div>
        @endforeach 
        
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 main text-left">
        	<table class="table table-hover">
            	<thead>
                	<tr>
                    	<td>Products</td>
                        <td>Qty</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                	<?php
                    $sum=0;
                    $i=0;
                    ?>
                    @foreach ($orders->products as $product)
                    <?php
                    $rowTotal=$product->price * $product->quantity;
                    $sum+=$rowTotal;
                    ?>
                    <tr>
                    	<td><div class="checkout-img"><img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image ?>" height="100" alt="<?php  echo $product->name; ?>" />
                        </div>
                        <br clear="all" />
                        <div class="row cart_product_name">
                          <?php  echo $product->name; ?>
                        </div>
                        
                        <?php
                        
                        $attributes=explode(',',$product->attribute);
                        $values=explode(',',$product->value);
                        while(list($key, $attribute) = each($attributes) and list($key, $value) = each($values) )                    {
                            if($value=='--')
                            continue;
                            
                        ?>
                        <div class="row cart_attribute_name">
                          <p ><?php  echo $attribute; ?> : <?php echo $value?></p>
                        </div>
                        <?php
                        $i++;
                        }
                        
                        ?>
                        
                        </td>
                        <td><?php echo $product->quantity?></td>
                        <td><span class="txt-price">{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $product->price?></span></td>
                        
                    </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>