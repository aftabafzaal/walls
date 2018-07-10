<?php
$cart = Session::get('cart');
?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart fa-2"></i> <span>Cart<sup class="badge"><?php echo ($countCart); ?></sup></span> </a>

<ul class="dropdown-menu">
    <?php if (count($cart) > 0) { ?>
        <?php
        foreach ($cart as $product) {
            ?>
            <li><?php echo $product->product_name ?></li> 
        <?php } ?>
        <li>
            <div class="p10 col-sm-12"><a class="btn btn-warning" href="{{url('cart/view')}}" class="pagelinkcolor"><i class="fa fa-arrow-right"></i> View Cart</a>

                <a class="btn btn-primary" href="{{url('checkout')}}" class="pagelinkcolor"><i class="fa fa-shopping-cart"></i> Check out</a></div>
        </li>

    <?php } else { ?>
        <li><a href="javascript:void(0);" class="pagelinkcolor">No items</a></li> 
    <?php } ?>