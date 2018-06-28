<?php
$currency = Config::get('params.currency');
$symbol = $currency[Config::get('params.currency_default')]['symbol'];
?>
@if(count($products)>0)
<div class="hed lg bg-cvr" style="background-image:url('{{ asset('front/images/bundle-bg.png')}}')">
    <h2><span class="fl pin"><img src="{{ asset('front/images/pin2.png')}}" /></span>
        Bundles 
        <span class="fr pin"><img src="{{ asset('front/images/pin1.png')}}" /></span>
    </h2>
</div>
<div class="clearfix"></div>
@foreach ($products as $product)

<div class="prod col-sm-6">
    <div class="prod__inr">
        <div class="prod__img">
            <a href="<?php echo url('product/' . $product->id); ?>"><img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" /></a>
            <div class="imfo-area">
                <h3><?php echo $product->name; ?></h3>
                <h4> @include('front/products/price')</h4>
            </div>
        </div>
        <div class="prod__cont">
            <a class="btn btn-primary" onclick="AddToCart(<?php echo $product->id ?>, 1)"><span>BUY</span></a>
        </div>
    </div>
</div>
@endforeach
@else
<div class="warning">Sorry, there is no results for your search</div>
@endif
<script>
    function AddToCart(product_id) {

        var form = {product_id: product_id, quantity: 1};
        var jqxhr = $.get("{{url('cart/add')}}", form, function () {
            alert("Product added to cart.");
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