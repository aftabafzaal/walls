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

    </body>
</html>
