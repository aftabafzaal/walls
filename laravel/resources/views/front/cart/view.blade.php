@extends('login_signup')

@section('content')
<?php
//echo $countCart;
$currency = Config::get('params.currency');
?>


<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/bnr-cart1.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2>YOUR CURRENT ORDER</h2>
            <h4></h4>
        </div>
    </div>
</section>


<section class="table-area cart-table pt30">
    @if ($countCart > 0)
    <div class="container">

        @if ($countCart==0)<span>
            <div class="alert alert-success">
                <h4><i class="icon fa fa-check"></i> &nbsp  Your Basket is empty</h4>
            </div></span>
        @endif

        <div class="table-area  col-sm-12">
            <form id="cart_update" name="cart_update"  action="update" >
                <table class="table cart-item-table table-bordered table-topbot table-valign">
                    <thead>
                    <th class="col-sm-6">LAB TEST</th>
                    <th class="col-sm-2">PRICES</th>
                    <th class="col-sm-2">TOTAL</th>
                    </thead>
                    <?php
                    $sum = 0;
                    ?>
                    @foreach ($cart as $product)
                    <?php
                    $rowTotal = $product->total_price * $product->quantity;
                    $sum += $rowTotal;
                    ?>


                    <tr>
                        <td><!-- <span class="pic"><img src="images/pic.jpg" alt="" /></span> -->
                            <?php
                            if ( $product->type == "bundle") {
                                echo $product->product_name;
                            } else {
                                ?>
                                <a href="<?php echo url('product/' . $product->key); ?>" class="view-cat-link"><?php echo $product->product_name; ?></a>

                                <?php
                            }
                            
                            ?>

                        </td>
                        <td><span class="txt-price">{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $product->total_price ?></td>
                        <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $rowTotal; ?></td>
                    </tr>
                    @endforeach
                </table>
            </form>
        </div>
        <div class="table-total-area col-sm-4 col-sm-offset-2 pul-rgt">
            <table class="table  table-bordered table-topbot">
                <thead>
                <th colspan="2">CART TOTALS</th>
                </thead>

                <tr>
                    <td>Subtotal</td>
                    <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $sum; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{ $currency[Config::get('params.currency_default')]['symbol']}}<?php echo $sum; ?></td>
                </tr>
            </table>
        </div>

        <div class="clearfix"></div>

        <div class="btn-group pul-rgt pr20">
            <a href="{!! url('shop') !!}" class="btn  btn-primary" >Continue Shoping <i class="fa fa-arrow-right"></i></a>
            <a href="{!! url('checkout') !!}" class="btn  btn-success">Proceed to Checkout <i class="fa fa-shopping-cart"></i></a>
        </div>

    </div>


    @endif
</section>





@endsection

<script>


    function add(product_id, price, quantity) {

        //    return false;


        var form = {product_id: product_id, total_price: price, quantity: quantity};
        var jqxhr = $.get("../cart/add", form, function () {
            // alert( "Product added to cart." );
            window.location = "../cart/view";

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

    function deleteCart(id) {

        window.top.location = "../cart/delete/" + id;
    }
    function submitCart() {
        $('#cart_update').submit();
    }
</script>

