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
        <!-- Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400i|Source+Sans+Pro:300,400,600,700" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">

        <!-- CSS -->

        <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">


        <link rel="stylesheet" href="{{ asset('frontlte/css/themefisher-fonts.css')}}">
        <link rel="stylesheet" href="{{ asset('frontlte/css/owl.carousel.css')}}">

        <link rel="stylesheet" href="{{ asset('frontlte/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{ asset('frontlte/css/style.css')}}">

        <link rel="stylesheet" href="{{ asset('frontlte/css/responsive.css')}}">
        <script src="{{ asset('/front/js/jquery-2.2.4.min.js') }}"></script>
        <style>


            .img-wrap-tailor a{display:block}
            .img-wrap-tailor{    width: 100%;
                                 float: left;
                                 overflow: hidden;
                                 height: 300px;
                                 position: relative;}
            .img-wrap-tailor span{    position: absolute;
                                      background: #ff6600;
                                      width: 100%;
                                      left: 0;
                                      bottom: 0;
                                      text-align: center;
                                      padding: 5px 0;
                                      font-size: 19px;
                                      color: #fff;}
            .box-customn{    width: 100%;
                             float: left;
                             border: 1px solid #ccc;
                             margin: 15px 0;box-shadow:0 0 5px #000;}
            .box-customn .imfo-area{width:100%; float:left;text-align:center;}
            .box-customn .imfo-area h3{    margin: 0px;
                                           padding: 0px;
                                           color: #0c0c0c;
                                           font-size: 21px;
                                           line-height: 30px;
                                           font-weight: 600;
                                           text-transform: uppercase;}
            .box-customn .imfo-area p{margin: 0px;padding:5px 0px;font-size:14px;}
            .box-customn .imfo-area h4{color: #ff0000;
                                       font-weight: bold;
                                       line-height: 30px;
                                       font-size: 25px;}
            .img-wrap-tailor img{max-width:100%;}
            .box-customn a.onhover{display:none;}
            .box-customn:hover a.onhover{display:block;position:absolute;top:0px;left:0px;}
            .box-customn:hover a.nohover{display:none;}
        </style>

    </head>
    <body id="body">
        <div id="preloader-wrapper">
            <div class="pre-loader"></div>
        </div>

        @include('front/common/navigation')

        @yield('content')
        @include('front/common/footer')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
        <script src="{{ asset('frontlte/js/modernizr-2.6.2.min.js') }}"></script>
        <script src="{{ asset('frontlte/js/owl.carousel.min.js') }}"></script>

        <script src="{{ asset('frontlte/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontlte/js/main.js') }}"></script>

        <script>



$(document).ready(function () {
    $.ajax({
        url: "{{url('get-bundle-products')}}",
        cache: false
    }).done(function (html) {
        $("#bundle_products").append(html);
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
