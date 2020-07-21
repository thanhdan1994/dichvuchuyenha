<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Directing Template">
    <meta name="keywords" content="Directing, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.svg">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/favicon.svg" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Directing | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css"')}} type="text/css">
    <link rel="stylesheet" href="{{asset('css/barfiller.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="header__logo">
                    <a href="{{ route('index') }}"><img src="{{asset('img/logo.png')}}"></a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            @foreach($categories as $category)
                            <li>
                                <a href="#">{{ $category->name }}</a>
                                @if(count($category->posts) > 0)
                                <ul class="dropdown">
                                    @foreach($category->posts()->where('priority', true)->limit(10)->get() as $post)
                                    <li><a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header Section End -->

@yield('content')

<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="{{asset('img/footer-logo.png')}}"></a>
                    </div>
                    <p>Challenging the way things have always been done can lead to creative new options that reward
                        you.</p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-6">
                <div class="footer__address">
                    <ul>
                        <li>
                            <span>Call Us:</span>
                            <p>(+12) 345-678-910</p>
                        </li>
                        <li>
                            <span>Email:</span>
                            <p>info.colorlib@gmail .com</p>
                        </li>
                        <li>
                            <span>Fax:</span>
                            <p>(+12) 345-678-910</p>
                        </li>
                        <li>
                            <span>Connect Us:</span>
                            <div class="footer__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-skype"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6">
                <div class="footer__widget">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">How it work</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Sign In</a></li>
                        <li><a href="#">How it Work</a></li>
                        <li><a href="#">Advantages</a></li>
                        <li><a href="#">Direo App</a></li>
                        <li><a href="#">Packages</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                    <div class="footer__copyright__links">
                        <a href="#">Terms</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('js/jquery.barfiller.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>
