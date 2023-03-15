@extends('layouts.layout')
@section('pageContent')
    <!-- Slider -->
    <!-- Note: If you don't want the black shadow on the picture. Remove this class: data-overlay-dark="4" -->
    <header class="header valign bg-img parallaxie" data-scroll-index="0" data-overlay-dark="4"
        data-background="../main/img/team/3.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption">
                    <hr class="line line-hr-primary animate-box" data-animate-effect="fadeInUp">
                    <h5 class="animate-box" data-animate-effect="fadeInUp">Makeup Artist</h5>
                    <h1 class="animate-box" data-animate-effect="fadeInUp">{{ config('app.name') }}</h1> <a href="#"
                        data-scroll-nav="1" class="btn fl-btn animate-box" data-animate-effect="fadeInUp">About</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="arrow bounce text-center">
                        <a href="index.html#about" class=""> <i class="ti-angle-double-down"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <hr class="line-vr-section">

    <!-- About -->
    <div id="about" class="about section-padding" data-scroll-index="1">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-5">
                    <div class="about-img mb-30 img-fluid animate-box" data-animate-effect="fadeInUp"
                        style="background-image: url('../main/img/about.jpg');">
                        <div class="about-img-2 signature" style="background-image: url('../main/img/signature.png');">
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-12 animate-box" data-animate-effect="fadeInUp">
                    <div class="title"> <span>About</span>
                        <h2>{{ config('app.name') }}</h2>
                        <hr class="line line-hr-secondary">
                    </div>
                    <p>Hi, I'm {{ config('app.name') }} a Professional Makeup Artist. Quisque luctus tincidunt enim dapibus
                        pharetra neue ultricies at. Morbi dapibus mauris id scelerisque placerat nula massa lacinia orci in
                        facilisis nulla quam volutpat lectus. Nunc elementum ante commodo felis hendrerit.</p>
                    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia. Makeup a urnue sem
                        tempor ullamcorper. Praesent sapien felis porttitor ut eros pharetra fermentum solli citudi metus.
                        Quisque facilisis libero libero eget cursus ex maximus non. Quisque volutpat venenatis lacus. Nullam
                        ac sapien sed metus varius mattis et vel magna.</p>
                    <br />

                </div>
            </div>
        </div>
    </div>
    <!-- End about line -->

    <!-- Services Icon Banner -->
    <section class="services-banner-wrap" id="services">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                    <img src="{{ asset('main/img/banner2.jpg') }}" class="img-fluid" alt="">
                </div> --}}
                <div class="col-md-12 animate-box" data-animate-effect="fadeInRight">
                    <div class="cont">
                        <div class="row gx-0">
                            <div class="col-6 col-md-4 services-banner">
                                <div class="icon"><span class="flaticon-039-make-up"></span></div>
                                <h6>Facial Makeup</h6>
                            </div>
                            <div class="col-6 col-md-4 services-banner">
                                <div class="icon"><span class="flaticon-007-mascara-4"></span></div>
                                <h6>Eyelash Makeup</h6>
                            </div>
                            <div class="col-6 col-md-4 services-banner">
                                <div class="icon"><span class="flaticon-013-facial-mask-1"></span></div>
                                <h6>Eye Makeup</p>
                            </div>
                            <div class="col-6 col-md-4 services-banner">
                                <div class="icon"><span class="flaticon-034-eyebrow"></span></div>
                                <h6>Eyebrow Makeup</h6>
                            </div>
                            <div class="col-6 col-md-4 services-banner">
                                <div class="icon"><span class="flaticon-018-scissors"></span></div>
                                <h6>Haircut Makeup</h6>
                            </div>
                            <div class="col-6 col-md-4 services-banner">
                                <div class="icon"><span class="flaticon-037-dressing-table"></span></div>
                                <h6>Dressing Table</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services -->

    <!-- Pricing -->
    <section id="pricing" class="section-padding bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title mb-30"> <span>Prices</span>
                        <h2>Pricing Plan</h2>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="price-list">
                        <div class="price-box-inner" style="background-image: url(main/img/pricing/a.jpg); opacity:0.9;">
                            <h3>General Pricing List</h3>
                            <ul>
                                @forelse ($categories as $cat)
                                    <li>
                                        <p class="package">{{ $cat->category }}</p>
                                        <div class="border-middle"></div><span
                                            class="price">&#8358;{{ number_format($cat->price, 2) }}</span>
                                    </li>
                                @empty
                                    <li>
                                        <p class="package">No Price tag available at the moment</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end pricing plan -->

    <!-- Contact -->
    <section id="contact" class="contact section-padding" data-scroll-index="7">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title"> <span>Location</span>
                        <h2>Contact Us</h2>
                        <hr class="line line-hr-secondary">
                    </div>
                </div>
                
                <div class="col-md-12">
                    <form method="post" class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name *" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email / Phone">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea name="message" id="message" cols="30" rows="4" class="form-control" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn fl-btn" type="submit">Contact!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--end contact -->
@endsection
