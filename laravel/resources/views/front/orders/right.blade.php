<div class="order-cont">
    <span class="order-total-head">Order Total</span>
    <!--
    <span class="order-total-descrp">Shipping costs and taxes will be evaluated 
    during checkout</span>-->
    <ul>
        <li><span class="subtotal-txt">Subtotal:</span><span class="subtotal-txt subtotal-txt2">{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $sum; ?></span></li>
        <?php
        $discount = 0;
        //d($coupon['coupons']->id,1);
        if (isset($coupon['coupons']->id)) {
            $discount = $coupon['discount'];
            ?>
            <li><span class="subtotal-txt">Discount:</span><span class="subtotal-txt subtotal-txt2">{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $discount; ?></span></li> 
            <?php
        }
        ?>                           
        <li><span class="subtotal-txt">Total:</span><span class="subtotal-txt subtotal-txt2">{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $sum - $discount; ?></span></li>
    </ul>
</div>
<div class="order-cont order-cont2">
    <span class="order-total-head">Apply Discount Coupon</span>
    @if (Session::has('error'))
    <div class="alert alert-warning">
        {!! session('error') !!}
    </div>
    @endif
    <form class="" action="<?php echo url(); ?>/coupons/apply" method="post">
        <input type="hidden"  name="_token" value="{{ csrf_token() }}" />
        <ul>
            <li><input required type="text" name="coupon" id="coupon" /></li>
            <li><input type="submit" value="Apply" /></li>
        </ul>
        <input type="hidden" name="subTotal" value="<?php echo $sum; ?>"/>


    </form>
</div>