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
    <!-- Sidebar Section -->
    <a href="#" class="js-ovon-nav-toggle ovon-nav-toggle"><i></i></a>
    <aside id="ovon-aside">
        <!-- Logo -->
        <div class="ovon-logo">
            <a href="index.html">
                <!-- <img src="../main/img/logo-dark.png" alt="">  -->
                BBKC
            </a>
        </div>
        <!-- Menu -->
        <nav class="ovon-main-menu">
            @guest
            <ul>
                <li><a href='index.html#home'>Home</a></li>
                <li><a href='index.html#about'>About</a></li>
                <li><a href='index.html#services'>Services</a></li>
                <li><a href='index.html#pricing'>Pricing</a></li>
                <li><a href='index.html#portfolio'>Portfolio</a></li>
                <li><a href='index.html#contact'>Contact</a></li>
                <li><a href="{{route('login')}}">Get Started</a></li>
                <!--
                <li class="ovon-sub"><a href="#0">Dropmenu</a>
                    <ul>
                        <li><a href="#0">Submenu</a></li>
                        <li><a href="#0">Submenu</a></li>
                        <li class="ovon-sub"><a href="#0">Dropmenu</a>
                            <ul>
                                <li><a href="#0">Submenu</a></li>
                                <li><a href="#0">Submenu</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                -->
            </ul>
            @endguest

            @auth
            @if (auth()->user()->is_admin)
            <ul>
                <li><a href="{{route('booking')}}">Bookings</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">MakeUp Class</a></li>
                <li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn">LogOut</button>
                    </form>
                </li>
            </ul>
            @else
            <ul>
                <li><a href="{{route('booking')}}">Book Make Up</a></li>
                <li><a href="{{route('users.learn-make-up')}}">Learn make up</a></li>
                <li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn">LogOut</button>
                    </form>
                </li>
            </ul>
            @endif
            @endauth

        </nav>
        <!-- Sidebar Footer -->
        <div class="ovon-footer">
            <div class="separator"></div>
            <ul>
                <li><a href="#"><i class="ti-instagram"></i></a></li>
                <li><a href="#"><i class="ti-twitter"></i></a></li>
                <li><a href="#"><i class="ti-facebook"></i></a></li>
                <li><a href="#"><i class="ti-pinterest"></i></a></li>
            </ul>
            <p>&copy; 2022 OVON by DuruThemes.</p>

        </div>
    </aside>
    <div id="ovon-main">

        @yield('pageContent')

        <!-- line -->
        <hr class="line-vr-section">
        <!-- Footer -->
        <footer class="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-30">
                        <a href="index.html"> <img src="img/logo-dark.png" alt=""> </a>
                        <p>Hi, I'm Olivia a Professional Makeup Artist. Quisque luctus tincidunt enim daibus miss neuenete ultrie ectus.</p>
                        <div class="social-icon"> <a href="index.html"><i class="ti-facebook"></i></a> <a href="index.html"><i class="ti-twitter"></i></a> <a href="index.html"><i class="ti-instagram"></i></a> <a href="index.html"><i class="ti-pinterest"></i></a> </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <h6>Get in touch</h6>
                        <ul class="list-unstyled footer-list">
                            <li>
                                <div class="icon"><i class="ti-headphone-alt"></i></div>
                                <div class="text">
                                    <p><a href="tel:+1-650-444-0000">+1 650-444-0000</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon"> <i class="ti-email"></i> </div>
                                <div class="text">
                                    <p><a href="mailto:makeup@ovon.com">makeup@ovon.com</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon"> <i class="ti-location-pin"></i> </div>
                                <div class="text">
                                    <p>525 West Ave, CT 06850 Norwalk</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-30">
                        <h6>Opening Hours</h6>
                        <div class="footer-table">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Mon - Fri :</td>
                                        <td>10am - 7pm</td>
                                    </tr>
                                    <tr>
                                        <td>Saturday :</td>
                                        <td>10am - 5pm</td>
                                    </tr>
                                    <tr>
                                        <td>Sunday :</td>
                                        <td><a href="tel:+1-650-444-0000">By Call</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-left">
                                <p>© Copyright 2022. All right reserved.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="right"><a href="#">Terms &amp; Conditions</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
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