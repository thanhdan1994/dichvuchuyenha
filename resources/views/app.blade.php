




<!doctype html>

<html>

<head>

    <meta charset="utf-8">

    <title>15+ năm Dịch vụ chuyển nhà trọn gói, chuyển văn phòng, taxi tải - Tín Phát Express</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">

    <meta http-equiv="Content-Language" content="vi" />

    <meta name="language" content="vietnamese">

    <link href="/favicon.svg" rel="shortcut icon" />

    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome-free-5.14.0-web/css/all')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.mmenu.all.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/binh.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/grid.css')}}">

    <link href="{{asset('css/swiper.min.css')}}" type="text/css" rel="stylesheet" />



    <script src="{{asset('js/jquery-1.10.1.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/swiper.min.js')}}"></script>

    <script src="{{asset('js/jquery.form.min.js')}}"></script>

    <script src="{{asset('js/jquery.mmenu.min.all.js')}}"></script>

    <script src="{{asset('js/script.js')}}"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400,700,800,800i&amp;subset=vietnamese" rel="stylesheet">
</head>



<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZW7DWX"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="pos-re">
    <div class="header">
        <div class="pos-re">
            <div class="grid">
                <div class="contain-banner">
                    <div class="flex-container">
                        <div class="cell-2-4 pad-cell-3-4 outer-logo">
                            <div class="logo">
                                <a href="{{ route('index') }}"><img src="{{asset('images/logo3.png')}}" alt="Logo" style="max-width:100%"  /></a>
                            </div>
                            <div class="slogan">
                                <img src="{{asset('images/slogin.png')}}">
                            </div>
                        </div>
                        <div class="cell-2-4 pad-cell-1-4 outer-right">
                            <div class="menu-top">
                                <div class="menuitem m-width-1240">
                                    <a href="{{ route('introduce') }}" class="hide-on-mobile">Giới Thiệu </a>
                                    <a href="tel: 0931.890.990" class="hide-on-mobile"><i class="fa fa-envelope-o"></i> Liên hệ</a>
                                </div>
                            </div>
                            <div class="c"></div>
                            <div class="search-destop">
                                <form id="frmseach" action="https://chuyennhathanhtam.vn/search/">
                                    <input name="qr" placeholder="Từ khóa" type="text">
                                    <a href="index.html#" class="btn-search" onclick="document.getElementById('frmseach').submit();"><img src="{{asset('images/btn_search1.png')}}"/></a>
                                </form>
                            </div>
                            <div class="hotline">
                                hotline: {{ $phoneGlobal }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menubar">
                <div class="grid">
                    <ul class="nav">
                        <li class="active menuhome"><a href="/">Trang chủ</a></li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('categories.posts.index', $category->slug) }}" class="">
                                {{ \Illuminate\Support\Str::upper($category->name) }}
                                @if(count($category->posts()->where('priority', true)->limit(3)->orderBy('id', 'desc')->get()) > 0)
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                                @endif
                            </a>
                            <ul>
                                @foreach($category->posts()->where('priority', true)->limit(10)->orderBy('id', 'desc')->get() as $post)
                                <li><a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                    <div class="show-900">
                        <div class="btn-mobile btn-nav-mobile">
                            <a href="#menu"><img src="images/bnt-nav-mobile.png"></a>
                        </div>
                        <div class="btn-mobile btn-show-phone-mobile bornone-m">
                            <a href="tel:0901729729"><img src="images/hot-fff.png" /></a>
                        </div>
                        <div class="btn-mobile btn-show-saerch-mobile bornone-m">
                            <a href="javascript:void(0)"><img src="images/btn_search.png" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c"></div>
            <div class="box-search-mobile">
                <form id="searchformmoble" method="get" action="https://chuyennhathanhtam.vn/search/">
                    <input type="text" style="outline:none" placeholder="Từ khóa" name="qr">
                    <a class="btn-search-mobile" href="index.html#" onClick="$('#searchformmoble').submit();"><i class="fa fa-search" aria-hidden="true"></i></a>
                </form>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    $(".btn-show-saerch-mobile").click(function () {
                        $(".box-search-mobile").stop().slideToggle("slow");
                    });
                });
            </script>
            <div class="c"></div>
        </div>
    </div>
    @yield('banners')
</div>
<div class="c"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".show-search-mobile").click(function () {
            $(".box-search-mobile").stop().slideToggle("slow");
        });
    });
</script>

<div class="c"></div>

@yield('content')

<div class="partner">
    <div class="grid">
        <div class="pos-re">
            <a href="index.html#" class="partner-prev"></a>
            <a href="index.html#" class="partner-next"></a>
            <div class="swiper-container" id="parner">
                <div class="swiper-wrapper">
                    <div class="swiper-slide partner-image" align="center"><a href="javascript: void(0)"><img src="{{asset('temp/-uploaded-partner_01_cr_174x89.png')}}" alt="01"></a></div>
                    <div class="swiper-slide partner-image" align="center"><a href="javascript: void(0)"><img src="{{asset('temp/-uploaded-partner_2_cr_174x89.png')}}" alt="2"></a></div>
                    <div class="swiper-slide partner-image" align="center"><a href="javascript: void(0)"><img src="{{asset('temp/-uploaded-partner_3_cr_174x89.png')}}" alt="3"></a></div>
                    <div class="swiper-slide partner-image" align="center"><a href="javascript: void(0)"><img src="{{asset('temp/-uploaded-partner_4_cr_174x89.png')}}" alt="4"></a></div>
                    <div class="swiper-slide partner-image" align="center"><a href="javascript: void(0)"><img src="{{asset('temp/-uploaded-partner_5_cr_174x89.png')}}" alt="5"></a></div>
                    <div class="swiper-slide partner-image" align="center"><a href="javascript: void(0)"><img src="{{asset('temp/-uploaded-partner_6_cr_174x89.png')}}" alt="6"></a></div>
                </div>
            </div>
            <script>
                var pview = 6;
                if ($(document).width() <= 980) {
                    pview = 5;
                    $('#parner').height(75);
                }
                if ($(document).width() <= 768) {
                    pview = 5;
                    $('#parner').height(75);
                }
                if ($(document).width() <= 680) {
                    pview = 4;
                    $('#parner').height(75);
                }
                if ($(document).width() <= 480) {
                    pview = 2;
                    $('#parner').height(70);
                }
                if ($(document).width() <= 320) {
                    pview = 2;
                    $('#parner').height(70);

                }

                var mySwiperParner = new Swiper('#parner', {
                    pagination: '#partner_pagination',
                    loop: true,
                    slidesPerViewFit: true,
                    grabCursor: true,
                    DOMAnimation: true,
                    paginationClickable: true,
                    cssWidthAndHeight: true,
                    // simulateTouch:false,
                    autoplay: 2000,
                    slidesPerView: pview,
                    speed: 600,
                    spaceBetween: 30,
                    nextButton: '.partner-prev',
                    prevButton: '.partner-next'

                })
            </script>
        </div>

    </div>
</div>
<div class="c"></div>
<div class="footer">
    <div class="inner-footer">
        <div class="grid">
            <div class="flex-container flex-container-space-between">
                <div class="cell-5-12 pad-cell-1-1">
                    <div class="title-footer">Công Ty Dịch Vụ Chuyển Nhà Tín Phát</div>
                    <div class="content-footer">
                        <div><img alt="contac địa chỉ" src="{{asset('uploaded/contact-address-icon.png')}}" style="height:23px; width:23px" />&nbsp;VPGD:&nbsp;{{ $addressGlobal }}</div>
                        <div><span style="font-size:14px"><strong>Hotline:</strong>&nbsp;{{ $phoneGlobal }} Mr Công.</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="copyright">
    <div class="grid">
        <div class="flex-container flex-container-space-between">
            <div class="cell-1-2 mobile-cell-1-1">
                Copyright 2017 -&nbsp; All Right Reserved.&nbsp;
            </div>
        </div>
    </div>
</div>



<nav id="menu">
    <ul>
            <li><a href="/">Trang chủ</a></li>
        @foreach($categories as $category)
            <li><a href="{{ route('categories.posts.index', $category->slug) }}">{{ \Illuminate\Support\Str::upper($category->name) }}</a>
            @foreach($category->posts()->where('priority', true)->limit(10)->orderBy('id', 'desc')->get() as $post)
            <li><a  href="{{ route('post.show', $post->slug) }}">-- {{ $post->name }}</a>
            @endforeach
        @endforeach
    </ul>
</nav>
</body>
</html>
