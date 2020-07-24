<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('GOOGLE_ANALYTICS') }}');
    </script>
    <meta charset="UTF-8">
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    @yield('metaName')
    <meta name="google-site-verification" content="XE0UPcgosGHbnIHodV2jKI0yD0iQinWI6C2_c7PBynE" />
    @yield('jsonLd')
</head>

<body>
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
                                <a href="{{ route('categories.posts.index', $category->slug) }}">{{ $category->name }}</a>
                                @if(count($category->posts) > 0)
                                <ul class="dropdown">
                                    @foreach($category->posts()->where(['priority' => true, 'status' => true])->limit(10)->get() as $post)
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
<div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon" style="left: -50px; bottom: 150px; position: fixed;">
    <div class="phonering-alo-ph-circle"></div>
    <div class="phonering-alo-ph-circle-fill"></div>
    <a href="tel: {{$phoneGlobal}}"></a>
    <div class="phonering-alo-ph-img-circle">
        <a href="tel: {{$phoneGlobal}}" class="pps-btn-img " title="Liên hệ">
            <img src="https://i.imgur.com/v8TniL3.png" alt="Liên hệ" width="50" onmouseover="this.src='https://i.imgur.com/v8TniL3.png';" onmouseout="this.src='https://i.imgur.com/v8TniL3.png';">
        </a>
    </div>
</div>
<div class="zalo-chat-widget" data-oaid="3352235758106363000" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="350" data-height="420"></div>

<script src="https://sp.zalo.me/plugins/sdk.js"></script>
<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright d-flex flex-column">
                    <span>Địa chỉ: {{ $addressGlobal }}</span>
                    <span>Điện thoại: <a href="tel:{{ $phoneGlobal }}">{{ $phoneGlobal }}</a></span>
                    <span>Email: <a href = "mailto: {{ $emailGlobal }}">{{ $emailGlobal }}</a></span>
                    <span>Website: <a href="{{ route('index') }}">https://chuyennhatinphat.vn</a></span>
                    <div class="footer__copyright__text">
                        <p>
                            &copy; Copyright <script>document.write(new Date().getFullYear());</script> by Tín Phát Express
                        </p>
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
<script src="{{asset('js/jquery.slicknav.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@yield('js')
</body>

</html>
