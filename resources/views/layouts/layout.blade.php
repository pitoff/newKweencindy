<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kween cindy</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Didact+Gothic&amp;family=Oswald:wght@300;400;500;600;700&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('main/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}">
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
        <div class="">
            <a href="/">
                <img src="{{ asset('main/img/kweencindyLogo.png') }}" alt="" style="height: 80px;">
            </a>
        </div>
        <!-- Menu -->
        <nav class="ovon-main-menu">
            @guest
                <ul>
                    <li><a href='#home'>Home</a></li>
                    <li><a href='#about'>About</a></li>
                    <li><a href='#services'>Services</a></li>
                    <li><a href='#pricing'>Pricing</a></li>
                    <li><a href='#contact'>Contact</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    
                    {{-- <li class="ovon-sub"><a href="#0">Dropmenu <span class="ti-arrow-down"></span> </a>
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
                    </li> --}}
                </ul>
            @endguest

            @auth
                <ul>
                    @if (admin())
                        {{-- <p>{{ auth()->user()->role }}</p> --}}
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="#">Users</a></li>
                        <li class="ovon-sub"><a href="#0">Booking</a>
                            <ul>
                                <li><a href="{{ route('already_booked') }}">Bookings</a></li>
                                <li><a href="{{route('my_booking', auth()->user()->id)}}">My Bookings</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('categories.index')}}">Categories</a></li>
                        <li><a href="{{route('payment.index')}}">Payment</a></li>
                        <li><a href="{{ route('image-gallery.index') }}">Gallery</a></li>
                    @endif

                    @if (defaultUser())
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="ovon-sub"><a href="#0">Booking </a>
                            <ul>
                                <li><a href="{{ route('already_booked') }}">Bookings</a></li>
                                <li><a href="{{route('my_booking', auth()->user()->id)}}">My Bookings</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('priceTags')}}">Pricing List</a></li>
                        <li><a href="{{route('image-gallery.index')}}">Gallery</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn"> LogOut</button>
                        </form>
                    </li>
                </ul>
            @endauth

        </nav>
        <!-- Sidebar Footer -->
        <div class="ovon-footer">
            <div class="separator"></div>
            {{-- <ul>
                <li><a href="#"><i class="ti-instagram"></i></a></li>
                <li><a href="#"><i class="ti-twitter"></i></a></li>
                <li><a href="#"><i class="ti-facebook"></i></a></li>
                <li><a href="#"><i class="ti-pinterest"></i></a></li>
            </ul> --}}
            <p>&copy; {{ date('Y') }}.</p>

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
                        <p>Hi, I'm {{config('app.name')}} a Professional Makeup Artist. Quisque luctus tincidunt enim daibus miss
                            neuenete ultrie ectus.</p>
                        <div class="social-icon"> <a href="index.html"><i class="ti-facebook"></i></a> <a
                                href="index.html"><i class="ti-twitter"></i></a> <a href="index.html"><i
                                    class="ti-instagram"></i></a> <a href="index.html"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <h6>Get in touch</h6>
                        <ul class="list-unstyled footer-list">
                            <li>
                                <div class="icon"><i class="ti-headphone-alt"></i></div>
                                <div class="text">
                                    <p><a href="tel:+1-650-444-0000">+234-8077994011</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon"> <i class="ti-email"></i> </div>
                                <div class="text">
                                    <p><a href="#">{{contactEmail()}}</a></p>
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
                                <p>© Copyright {{ date('Y') }}. All right reserved.</p>
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
    <script src="{{ asset('main/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('main/js/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('main/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('main/js/scrollIt.min.js') }}"></script>
    <script src="{{ asset('main/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('main/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('main/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('main/js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('main/js/main.js') }}"></script>
</body>

</html>
