<?php
$currency = Config::get('params.currency');
$symbol = $currency[Config::get('params.currency_default')]['symbol'];
?>
<div class="test-menu-area table-responsive0">
    <div class="heading">
        <h1>Select Your Desire Bundle</h1>
    </div>

    
    <div class="container">

        @if(count($products)>0)
        @foreach ($products as $product)

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="box-customn">
                <div class="img-wrap-tailor">
                    <a href="<?php echo url('product/' . $product->id); ?>"><img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" /></a>
                    View</span>
                    <a onclick="AddToCart(<?php echo $product->id ?>, 1)"><span>Add To Cart</span></a>
                </div>
                <div class="imfo-area">
                    <h3><?php echo $product->name; ?></h3>
                    <h4> @include('front/products/price')</h4>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="warning">Sorry, there is no results for your search</div>
        @endif

    </div>
</div>
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