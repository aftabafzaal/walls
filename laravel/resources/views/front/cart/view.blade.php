@extends('front')

@section('content')

<div id="fh5co-contact" class="__web-inspector-hide-shortcut__">
    <div class="container">
        <?php
        $currency = Config::get('params.currency');
        ?>
        <div class="row">
            <div class="container-fluid">
                <div class="checkout-back">
                    @if (count($cart)==0)
                    <div class="alert alert-success">
                        <h4><i class="icon fa fa-check"></i> &nbsp  Your Basket is empty</h4>
                    </div>
                    @endif
                    @if (count($cart)>0)
                    <div class="cart__main col-sm-8">
                        <div class="check-left-sect">
                            <form id="cart_update" name="cart_update"  action="update" >
                                <table class="table table-fit ">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Delete</th>
                                            <th>Qty</th>
                                            <th>Single</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sum = 0;
                                        ?>
                                        @foreach ($cart as $product)
                                        <?php
                                        $rowTotal = $product->total_price * $product->quantity;
                                        $sum+=$rowTotal;
                                        ?>
                                        <tr>
                                            <td>
                                                <udl class="__img">
                                                    <?php
                                                    
                                                        ?>
                                                        <li class="checkout-img">
                                                            <img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image ?>" height="100" alt="<?php echo $product->product_name; ?>" />
                                                        </li>
                                                        <li><?php echo $product->product_name; ?></li>
                                                        <?php
                                                    
                                                    ?>

                                                </ul>
                                            </td>
                                            <td><div class="btn btn-danger white trash-icon"><a href="../cart/delete/<?php echo $product->cart_id ?>"><i class="fa fa-trash"></i></a></div></td>
                                            <td><input size="1" class="qty-txt" name="qty[<?php echo $product->cart_id ?>]" value="<?php echo $product->quantity ?>" maxlength="2" /></td>
                                            <td><span class="txt-price">{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $product->total_price ?></span></td>
                                            <td><span class="txt-price">{{ $currency[Config::get('params.currency_default')]['symbol']}} <?php echo $rowTotal; ?></span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <ul class="checkout-btm-lnks signalized--hover">
                                    <li><a href="{!! url('/') !!}"> <i class="fa fa-arrow-circle-right"></i>  Continue Shoping</a></li>
                                    <li><a href="javascript:void(0);" onclick="submitCart();"> <i class="fa fa-refresh"></i> Update Cart</a></li>
                                    <li><a href="{!! url('checkout') !!}"> <i class="fa fa-shopping-cart"></i> Proceed to checkout</a></li>
                                </ul>
                            </form >
                        </div>

                        <table width="100%" border="0" id="cart_upselling"><tbody>

                                @foreach ($products as $product)
                                <tr>
                                    <td></td>
                                    <td>
                                        <?php echo $product->name ?>
                                        <form action="../cart/addsimple" method="get">
                                            <input type="hidden" name="total_price" value="<?php echo $product->price ?>">
                                            <input type="hidden" name="return" value="cart/view"/>
                                            <input type="hidden" name="price"  id="price" value="<?php echo $product->price; ?>" />
                                            <input type="hidden" name="quantity" value="1"/>
                                            <input type="hidden" name="product_id"  id="product_id" value="<?php echo $product->id; ?>" />							
                                            <p><strong>{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $product->price ?></strong> &nbsp; 
                                                <input type="submit" class="button" value="Add to Cart"/></p>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody></table>
                    </div>
                    <div class="cart__sidbar col-sm-4">
                        @include('front/orders/right')
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function submitCart() {
        $('#cart_update').submit();
    }
</script>
@endsection
