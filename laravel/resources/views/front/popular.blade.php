<?php
$currency = Config::get('params.currency');
$symbol = $currency[Config::get('params.currency_default')]['symbol'];
?>
@if(count($products)>0)
<div class="hed">
    <h2>POPULAR PRODUCTS</h2>
</div>
<div class="clearfix"></div>
<div class="swiper-container dontfly s1">
    <div class="swiper-wrapper">
        @foreach ($products as $product)

        <div class="swiper-slide">
            <div class="prod">
                <div class="prod__inr">
                    <div class="prod__img">
                        <a href="<?php echo url('product/' . $product->id); ?>"><img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" /></a>
                    </div>
                    <div class="prod__cont">
                        <a class="btn btn-primary" onclick="AddToCart(<?php echo $product->id ?>, 1)" href="#">BUY</a>
                    </div>

                </div>
                <div class="imfo-area">
                    <h3><?php echo $product->name; ?></h3>
                    <h4> @include('front/products/price')</h4>
                </div>
            </div>
        </div>

        @endforeach
        <div class="swiper-button-next swiper-button-next1"><i class="fa fa-angle-right"></i></div>
        <div class="swiper-button-prev swiper-button-prev1"><i class="fa fa-angle-left"></i></div>
    </div>
    @else
    <div class="warning"></div>
</div>
@endif
<script>
    function AddToCart(product_id) {

        var form = {product_id: product_id, quantity: 1};
        var jqxhr = $.get("{{url('cart/add')}}", form, function () {
            $("#mini_cart").html("")
            minicart();
            // window.location = "cart/view";

        })
                .done(function () {
                    //alert( "second success" );
                })
                .fail(function () {
                    //alert( "error" );
                })
                .always(function () {
                    //alert( "finished" );
                });

    }
</script>