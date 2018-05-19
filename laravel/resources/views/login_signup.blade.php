<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <title><?php echo Config('params.site_name'); ?> | @yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')" />
        <link rel="icon" type="image/png" href="{{ asset('front/images/favicon.png')}}">
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('front/style.css')}}">
        <link rel="stylesheet" href="{{ asset('front/css/colorized.css')}}">
        <link rel="stylesheet" href="{{ asset('front/css/animate.css')}}">
        <link rel="stylesheet" href="{{ asset('front/css/slidenav.css')}}">
        <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css')}}">
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-60562612-1', 'auto');
            ga('send', 'pageview');
        </script>
    </head>
    <body class="transition nav-plusminus slide-navbar slide-navbar--left">

        @include('front/common/navigation')
        <main id="page-content" >
            <section class="box-area text-center  pt20 pb50">
                @yield('content')
            </section>
            @include('front/common/footer')
        </main>
        <div id="loading"></div>
        <script src="{{ asset('/front/js/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ asset('/front/js/css_browser_selector.js') }}"></script>
        <script src="{{ asset('/front/js/site.js') }}"></script>
        <script src="{{ asset('/front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/front/js/viewportchecker.js') }}"></script>
        <script src="{{ asset('/front/js/kodeized.js') }}"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</html>