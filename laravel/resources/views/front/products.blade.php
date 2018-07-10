@extends('front')
<?php
$title = 'Shop';
$description = '';
$keywords = '';

$currency = Config::get('params.currency');
?>

@include('front/common/meta')
@section('content')
<section class="test-bd-area pt50 pb50" >
    <div class="container">
        <div class="test-menu-area table-responsive0">

            <h3>Shop</h3>

            <style>
                td[colspan] {
                    font-size: 28px;
                }
            </style>

            <div class="container">

                @if(count($products)>0)

                @foreach ($products as $p)
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="{{ asset('uploads/categories/thumbnail')}}/<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>" />

                </div>


                @foreach ($p['products'] as $product)

                <div class="prod col-lg-4 col-md-3 col-sm-6 col-xs-4">
                    <div class="prod__inr">
                        <a class="btn btn-primary" href="<?php echo url('product/' . $product->id); ?>"><img src="{{ asset('uploads/products/thumbnail')}}/<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>" /></a>
                        <div class="imfo-area">
                            <h3><?php echo $product->name; ?></h3>
                            <p><?php echo $product->teaser; ?></p>
                            <h4> @include('front/products/price')</h4>
                        </div>

                        <div class="prod__cont">
                            <a class="btn btn-primary" onclick="AddToCart(<?php echo $product->id; ?>)">BUY</a>
                        </div>

                    </div>
                </div>
                @endforeach

                @endforeach


                @else
                <div class="warning">Sorry, there is no results for your search</div>
                @endif

            </div>
        </div>
    </div>
</section>          
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

@endsection