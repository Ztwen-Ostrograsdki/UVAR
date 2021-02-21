<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Université Virtuelle UVAR</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/jquery-ui.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.js') }}" ></script>
    <script src="{{ asset('js/home.js') }}" ></script>
    <script src="{{ asset('master/js/modernizer.js') }}"></script>
    <!-- Site Icons -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/v4-shims.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bg.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('logos/uvar.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('master/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('master/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('master/style.css') }}" rel="stylesheet">
    <link href="{{ asset('master/css/versions.css') }}" rel="stylesheet">
    <link href="{{ asset('master/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('master/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('master/css/app.css') }}" rel="stylesheet">


    <!-- Modernizer for Portfolio -->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="host_version ">
    <div class="app bg-linear-official-dark">
        <navbar></navbar>
        <acceuil></acceuil>
    <div id="testimonials" class="parallax section db parallax-off" style="background-image:url('master/images/parallax_04.jpg');">
        <div class="container py-2">
            <div class="section-title text-center">
            </div><!-- end title -->

            {{-- <div class="row"> 
                <div class="col-md-12 col-sm-12">
                    <div class="testi-carousel owl-carousel owl-theme">
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                                <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="{{ asset('master/images/testi_01.png') }}" alt="" class="img-fluid">
                                <h4>James Fernando </h4>
                            </div>
                        </div>

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                                <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="{{ asset('master/images/testi_02.png') }}" alt="" class="img-fluid">
                                <h4>Jacques Philips </h4>
                            </div>
                        </div>
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                                <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                            </div>
                            <div class="testi-meta">
                                <img src="{{ asset('master/images/testi_03.png') }}" alt="" class="img-fluid ">
                                <h4>Venanda Mercy </h4>
                            </div>
                        </div>
                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                                <p class="lead">They have got my project on time with the competition with a sed highly skilled, and experienced & professional team.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="{{ asset('master/images/testi_01.png') }}" alt="" class="img-fluid">
                                <h4>James Fernando </h4>
                            </div>
                        </div>

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                                <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you completed.</p>
                            </div>
                            <div class="testi-meta">
                                <img src="{{ asset('master/images/testi_01.png') }}" alt="" class="img-fluid">
                                <h4>Jacques Philips </h4>
                            </div>
                        </div>

                        <div class="testimonial clearfix">
                            <div class="desc">
                                <h3><i class="fa fa-quote-left"></i> Great & Talented Team!</h3>
                                <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure itself, because it is very pursue pleasure. </p>
                            </div>
                            <div class="testi-meta">
                                <img src="{{ asset('master/images/testi_03.png') }}" alt="" class="img-fluid">
                                <h4>Venanda Mercy </h4>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>      --}}
        </div><!-- end container -->
    </div><!-- end section -->


    <footer class="footer">
        <home-footer></home-footer>
    </footer><!-- end footer -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">
                    <a class="navbar-brand d-inline text-official cursive cursor" href="/">
                        <img src="{{asset('logos/uvar.png')}}" class="d-inline m-0 p-0" width="" height="70">
                    </a>                   
                    <p class="footer-company-name">Tous droits reservés. &copy; 2021 <a href="#">UVAR</a> Design By : <a href="https://html.design/">html design</a></p>
                </div>

                <div class="footer-right">
                    <ul class="footer-links-soi">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="#"><i class="fa fa-telegram"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul><!-- end links -->
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
</div>
    <!-- ALL JS FILES -->


    <script src="{{ asset('master/js/all.js')}}"></script>
    <script src="{{ asset('master/js/custom.js') }}"></script>
    <script src="{{ asset('master/js/timeline.min.js') }}"></script>
       
    <script>
        $(document).click(function(event){
            if(!$(event.target).closest('.navbar-collapse').length){
                $('.navbar-collapse.show').collapse('hide')
            }
        })
    </script>
</body>
</html>