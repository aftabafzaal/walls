<?php
$currency = Config::get('params.currency');
$symbol = $currency[Config::get('params.currency_default')]['symbol'];
?>
@if(count($products)>0)

<div class="hed">
    <h2>FEATURED PRODUCTS</h2>
</div>
<div class="clearfix"></div>

@foreach ($products as $product)

<div class="prod col-sm-3">
    <div class="prod__inr">
        <div class="prod__img">
            <a class="btn btn-primary"  href="<?php echo url('product/' . $product->id); ?>"> <img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" /></a>
            <h3><?php echo $product->name; ?></h3>
            <h4> @include('front/products/price')</h4>
        </div>
        <div class="prod__cont">
            <a class="btn btn-primary" onclick="AddToCart(<?php echo $product->id ?>, 1)">BUY</a>
        </div>
    </div>
</div>
@endforeach
@else

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