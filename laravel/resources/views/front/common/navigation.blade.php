<header>
    <section class="hdr-area  hdr-nav  bg-cvr" style="background-image:url('{{ asset('front/images/header.png') }}')">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation" id="slide-nav">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand animated rubberBand delay2s" href="{{url('/')}}"><img src="{{ asset('front/images/logo.png') }}" alt="logo" class="broken-image"/></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div id="slidemenu">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-main fl">

                                <li><a href="#!3">Home</a></li>
                                <li><a href="#!6">About</a></li>
                                <li><a href="{{ url('shop')}}">Build your own Basket</a></li>
                                <li><a href="#bundle_products">Bundles</a></li>
                            </ul>

                            <ul class="nav navbar-nav fr ml50">
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
                                    <li><a href="{{ url('login')}}"><i class="icon"><img src="{{ asset('front/images/icon-user.png') }}" alt="" /></i></a></li>

                                    <?php
                                }
                                ?>
                                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><i class="icon"><img src="{{ asset('front/images/icon-cart.png') }}" alt="" /></i></a>
                                    <ul>
                                    <li class="cart-item" id="mini_cart">

                                    </li>
                                    </ul>
                                </li>
                            </ul>

                        </div> 
                    </div>
                </div> 
            </nav>
        </div>
    </section>
</header>
