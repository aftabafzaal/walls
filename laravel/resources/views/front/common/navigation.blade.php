
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

                <li class="cart-item" id="mini_cart">
                    
                </li>
            </ul>
        </div>
    </nav>
</div>
