<?php
$cart = Session::get('cart');
?>
<div class="container">
    <nav class="navbar navigation " id="top-nav">
        <a class="navbar-brand logo" href="#">
            <h1><a href="{{url('/')}}"  class="navbar-brand" ><img height="120" src="{{ asset('frontlte/images/logo.png') }}" alt="Logo" />
                        </a></h1>
        </a>

        <button class="navbar-toggler hidden-lg-up float-lg-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" >
            <i class="tf-ion-android-menu"></i>
        </button>
        <div class="collapse navbar-toggleable-md" id="navbarResponsive">
            <ul class="nav navbar-nav menu float-lg-right" id="top-nav">
                <li class=" active">
                    <a href="#">HOME</a>
                </li>
                <li class="">
                    <a href="{{ url('shop')}}">Shop</a>
                </li>
                <li class="">
                    <a href="#service">SERVICES</a>
                </li>
                <li class="">
                    <a href="#contact">CONTACT</a>
                </li>
                <?php
                if (isset(Auth::user()->id)) {
                    ?>
                    <li class=""><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('myorders')}}" class="pagelinkcolor">My Orders</a></li>
                            <li><a href="{{ url('changepassword')}}" class="pagelinkcolor">Change Password</a></li>
                            <li><a href="{{ url('profile')}}" class="pagelinkcolor">Profile</a></li>
                            <li><a href="{{ url('auth/logout')}}" class="pagelinkcolor">Log Out</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="login-link"><a href="{{url('login')}}">Login</a></li>

                    <?php
                }
                ?>

                <li class="cart-item">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart fa-2"></i> <span>Cart<sup class="badge"><?php // echo count($cart);          ?></sup></span> </a>

                    <ul class="dropdown-menu">
                        <?php if (count($cart) > 0) { ?>
                            <?php
                            foreach ($cart as $product) {
                                if ($product->type == 'additional') {
                                    continue;
                                }
                                ?>
                                <li><a href="{{url('product/')}}/<?php echo $product->key ?>" class="pagelinkcolor"><?php echo $product->product_name ?></a></li> 
                            <?php } ?>
                            <li>
                                <div class="p10 col-sm-12"><a class="btn btn-warning" href="{{url('cart/view')}}" class="pagelinkcolor"><i class="fa fa-arrow-right"></i> View Cart</a>

                                    <a class="btn btn-primary" href="{{url('checkout')}}" class="pagelinkcolor"><i class="fa fa-shopping-cart"></i> Check out</a></div>
                            </li>

                        <?php } else { ?>
                            <li><a href="javascript:void(0);" class="pagelinkcolor">No items</a></li> 
                            <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
