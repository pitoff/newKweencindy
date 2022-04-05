@extends('layouts.layout')
@section('pageContent')

<!-- Slider -->
<!-- Note: If you don't want the black shadow on the picture. Remove this class: data-overlay-dark="4" -->
<header class="header valign bg-img parallaxie" data-scroll-index="0" data-overlay-dark="4" data-background="../main/img/team/3.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-left caption">
                <hr class="line line-hr-primary animate-box" data-animate-effect="fadeInUp">
                <h5 class="animate-box" data-animate-effect="fadeInUp">Makeup Artist</h5>
                <h1 class="animate-box" data-animate-effect="fadeInUp">Kween Cindy</h1> <a href="#" data-scroll-nav="1" class="btn fl-btn animate-box" data-animate-effect="fadeInUp">About Me</a>
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
            <div class="col-md-5">
                <div class="about-img mb-30 img-fluid animate-box" data-animate-effect="fadeInUp" style="background-image: url('../main/img/about.jpg');">
                    <div class="about-img-2 signature" style="background-image: url('../main/img/signature.png');"></div>
                </div>
            </div>
            <div class="col-md-7 animate-box" data-animate-effect="fadeInUp">
                <div class="title"> <span>About Me</span>
                    <h2>Kween Cindy</h2>
                    <hr class="line line-hr-secondary">
                </div>
                <p>Hi, I'm Olivia a Professional Makeup Artist. Quisque luctus tincidunt enim dapibus pharetra neue ultricies at. Morbi dapibus mauris id scelerisque placerat nula massa lacinia orci in facilisis nulla quam volutpat lectus. Nunc elementum ante commodo felis hendrerit.</p>
                <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia. Makeup a urnue sem tempor ullamcorper. Praesent sapien felis porttitor ut eros pharetra fermentum solli citudi metus. Quisque facilisis libero libero eget cursus ex maximus non. Quisque volutpat venenatis lacus. Nullam ac sapien sed metus varius mattis et vel magna.</p>
                <br />
                
            </div>
        </div>
    </div>
</div>
<!-- line -->


@endsection