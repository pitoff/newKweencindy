<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kween cindy</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&amp;family=Oswald:wght@300;400;500;600;700&amp;display=swap">
    <link rel="stylesheet" href="{{asset('main/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('main/css/style.css')}}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144098545-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-144098545-1');
    </script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <!-- Preloader -->
    <div id="loader">
        <div class="loading">
            <div></div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    
    <div id="">

    @yield('pageContent')

    <!-- Footer -->
    
    </div>
    <!-- jQuery -->
    <script src="{{asset('main/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('main/js/modernizr-2.6.2.min.js')}}"></script>
    <script src="{{asset('main/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('main/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('main/js/scrollIt.min.js')}}"></script>
    <script src="{{asset('main/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('main/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('main/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('main/js/smooth-scroll.min.js')}}"></script>
    <script src="{{asset('main/js/main.js')}}"></script>
</body>

</html>