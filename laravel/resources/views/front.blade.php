<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--iPhone from zooming form issue-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
        <title><?php echo Config('params.site_name'); ?> | @yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')" />
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!-- Fonts -->
        <!-- Source Sans Pro 
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400i|Source+Sans+Pro:300,400,600,700" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
        -->
        <!-- CSS -->


        <!-- Bootstrap CDN 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

        -->
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('front/css/themefisher-fonts.css')}}">
        <link rel="stylesheet" href="{{ asset('frontlte/css/owl.carousel.css')}}">

        <link rel="stylesheet" href="{{ asset('frontlte/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{ asset('frontlte/css/style.css')}}">

        <link rel="stylesheet" href="{{ asset('frontlte/css/responsive.css')}}">
        <script src="{{ asset('/front/js/jquery-2.2.4.min.js') }}"></script>


        <link rel="icon" type="image/png" href="{{ asset('front/images/favicon.png')}}">

        <link rel="stylesheet" href="{{ asset('front/css/stylized.css')}}" data-content="animateCss, fontAwesome, "> 
        <link rel="stylesheet" href="{{ asset('front/css/animate.css')}}" data-content="animateCss, fontAwesome, "> 


        <link rel="stylesheet" href="{{ asset('front/css/animate.css')}}css/animate.css" data-content="animateCss, fontAwesome, ">
        <link rel="stylesheet" href="{{ asset('front/style.css')}}">
        <link rel="stylesheet" href="{{ asset('front/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('front/css/swiper.min.css')}}">
        <!-- jQuery -->
        <!--[if (!IE)|(gt IE 8)]><!-->

        <!--<![endif]-->


        <!--[if lte IE 8]>
          <script src="{{ asset('front/js/jquery1.9.1.min.js')}}"></script>
        <![endif]-->


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="{{ asset('front/js/html5shiv.min.js')}}"></script>
        <script src="{{ asset('front/js/respond.min.js')}}"></script>
          
        <![endif]-->




    </head>
    <body id="body" class="transition nav-plusminus slide-navbar slide-navbar--right">
        <div id="preloader-wrapper">
            <div class="pre-loader"></div>
        </div>
        <div class="wrapper">
            @include('front/common/navigation')
            <main id="page-content" class="container">
                @yield('content')
            </main>
            @include('front/common/footer')

        </div>



        <script src="{{ asset('front/js/jquery-2.2.4.min.js')}}"></script> 
        <script src="{{ asset('front/js/modernizr-2.6.2.min.js') }}"></script>
        <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>

        <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('front/js/main.js') }}"></script>

        <!--Bootstrap-->
        <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
        <!--./Bootstrap-->

        <!--Major Scripts-->
        <script src="{{ asset('front/js/kodeized.js') }}"></script>
        <script src="{{ asset('front/js/viewportchecker.js') }}"></script>
        <script src="{{ asset('front/js/customized.js') }}"></script>

        <!--./Major Scripts-->


        <!--Swiper Slider-->
        <script src="{{ asset('front/js/swiper.jquery.min.js') }}"></script>
        <script>
var swiper1 = new Swiper('.s1', {
    pagination: '.swiper-pagination',
    slidesPerView: '3',
    centeredSlides: false,
    paginationClickable: true,
    nextButton: '.swiper-button-next1',
    prevButton: '.swiper-button-prev1',
    spaceBetween: 15,
    autoplay: 2500,
    autoplayDisableOnInteraction: false,
    breakpoints: {
        1024: {slidesPerView: 3, spaceBetween: 40},
        768: {slidesPerView: 3, spaceBetween: 30},
        640: {slidesPerView: 1, spaceBetween: 20},
        320: {slidesPerView: 1, spaceBetween: 10}
    }
});


        </script>


        <script>






            $(document).ready(function () {
                $.ajax({
                    url: "{{url('get-bundle-products')}}",
                    cache: false
                }).done(function (html) {
                    $("#bundle_products").html(html);
                });


                $.ajax({
                    url: "{{url('get-featured-products')}}",
                    cache: false
                }).done(function (html) {
                    $("#featured_products").html(html);
                });

                $.ajax({
                    url: "{{url('get-popular-products')}}",
                    cache: false
                }).done(function (html) {
                    $("#popular_products").html(html);
                });

            });

            function minicart() {
                $.ajax({
                    url: "{{url('mini-cart')}}",
                    cache: false
                }).done(function (html) {
                    $("#mini_cart").append(html);
                });
            }





            minicart();

        </script>



    </body>
</html>
