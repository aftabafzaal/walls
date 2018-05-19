<?php
use App\Functions\Functions;
$currency = Config::get('params.currency');
$price = Functions::getPrice(Auth::user(), $product);
?>
@extends('front')
<?php
$title = $product->name;
$description = $product->teaser;
$keywords = $product->keywords;;
?>
@include('front/common/meta')
@section('content')
<section class="bnr-area page-bnr-area bg-full bg-cntr valigner" style="background-image:url('{{ asset('front/images/testmenu2.jpg') }}');">
    <div class="container">
        <div class="bnr__cont valign white text-center col-sm-12 text-uppercase anime-flipInX">
            <h2></h2>
            <h3><?php echo $product->name; ?></h3>
        </div>
    </div>
</section>
<section class="description-area">
    <div class="container">
        <div class="description-box col-sm-6">
            <div class="description__inr">
                <div class="description__cont">
                    <h3>{{Lang::get('front.description')}}</h3>
                    <?php echo $product->description; ?> 					
                </div>    
            </div> 			
        </div>
        <div class="description-box col-sm-6">
            <div class="description__inr">

                <div class="circle__cont text-center ">

                    <h3><?php echo $product->name; ?></h3>

                    <h2><sup><?php echo $currency[Config::get('params.currency_default')]['symbol'] ?></sup>{{$price}}</h2>
                    @if ($product->sale == 1 && $product->price > $product->salePrice)
                    <strong>Average competitors price</strong>
                    <h4><sup><?php echo $currency[Config::get('params.currency_default')]['symbol'] ?></sup>{{$product->price}}</h4>
                    <strong>Pricing based on average direct to consumer pricing.</strong>
                    @endif
                    <div class="checkout-area">
                        <button id="btn_add_to_cart"  class="out-btn btn btn-default">CHECKOUT</button>
                        <form id="form_add_to_cart" class="prod-detail-form">
                            <input type="hidden" value="1" name="quantity" id="quantity"  />
                            <input type="hidden" name="total_price"  id="total_price" value="<?php echo $price; ?>" />
                            <input type="hidden" name="price"  id="price" value="<?php echo $price; ?>" />
                            <input type="hidden" name="product_id"  id="product_id" value="<?php echo $id; ?>" />
                        </form>
                    </div> 
                </div>  

            </div> 			
        </div>		
    </div>
</section>

<section class="fasting-area">
    <div class="container">
        <div class="fasting-cont fasting-list clrlist listview">
            <?php echo $product->requirments; ?>

        </div>		
    </div>
</section>


<script>

    $(document).ready(function () {
        $("#btn_add_to_cart").click(function () {

            var price = $('#total_price').val();
            var form = $('#form_add_to_cart').serialize();

            //    return false;
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
        });


    });
</script>
@endsection