@extends('front')

@section('content')

<?php
$currency = Config::get('params.currency');
$symbol = $currency[Config::get('params.currency_default')]['symbol'];
?>

<section class="inr-intro-area pt100 pb40">
    <div class="container">
        <div class="page__title text-center mb30">
            <h2>BUNDLE PACKAGE TEST</h2>
            <span></span>
        </div>

        <p>We want you to get the most information about your body when information about “you” matter most. From wellness starters to proactive warrior&reg; tests holding over 100 bio markers, you get actionable information at your fingertips. You can order bundle tests and add individual tests from our test menu</p>
    </div>
</section>


<section class="packages-area bg-snow p30 mb30 box-scale--hover">
    <div class="container">

        <?php
        $thHead = "";
        $thPrice = "";
        $thBody = "";
        foreach ($model as $product) {

            if ($product->sale == 1 && $product->price > $product->salePrice)
                $price = $product->salePrice;
            else
                $price = $product->price;


            $thHead.="<th>" . $product->name . "</th>";
            $thPrice.="<th>" . $symbol . $price . "</th>";
            ?>
            <div class="pack-box col-sm-3 ">
                <div clsas="pack__hed">
                    <h4><?php echo $product->name; ?></h4>
                    <h2>@include('front/products/price')</h2>
                    <div class="rating-area clrlist">
                        <ul>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="cont">
                    <p><?php echo $product->teaser; ?></p>
                    <div class="lnk-btn inline-btns">
                                     <a href="javascript:void(0);" onclick="AddToCart('<?php echo $product->id ?>', '<?php echo $price ?>');" >Add to Cart</a>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
</section>
<script>
    function AddToCart(product_id, total) {

        var form = {product_id: product_id, total_price: total, quantity: 1};
        var jqxhr = $.get("cart/add", form, function () {
            //alert( "Product added to cart." );
            window.location = "cart/view";

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
    // window.location="cart/add?product_id="+product_id+"&total_price="+total+"&quantity=1";

</script>


<section class="table-area pack-table pt30 pb30 table-valign a--hidden">
    <div class="container">

        <table class="table table-hover">
            <thead>
            <th>Category</th>
            <th>Bio Markers</th>
            <?php
            echo $thHead;
            ?>
            </thead>
            <tr>
                <th> </th>
                <th> </th>
                <?php
                echo $thPrice;
                ?>
            </tr>


            <?php
            foreach ($categories as $id => $category) {
                if (empty($category['categories'])) {
                    continue;
                }
                ?>
                <tr>
                    <td colspan="<?php echo count($model) + 2; ?>"><?php echo $category['name']; ?></td>
                </tr>
                <?php
                foreach ($category['categories'] as $subCatId => $subCategory) {
                    ?>
                    <tr>
                        <td><a href="#">View</a></td>
                        <td><?php echo $subCategory; ?></td>

                        <?php
                        foreach ($model as $product) {

                            if (isset($productCategories[$product->id]) && in_array($subCatId, $productCategories[$product->id])) {
                                $class = "check";
                            } else {
                                $class = "times";
                            }
                            ?>
                            <td><i class="fa fa-<?php echo $class; ?>"></i></td>
                                <?php
                            }
                            ?>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</section>      


@endsection