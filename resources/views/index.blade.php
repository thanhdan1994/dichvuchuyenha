@extends('app')

@section('banners')
    <link rel="stylesheet" type="text/css" href="{{asset('css/flexslider.css')}}">
    <script src="{{asset('js/jquery.flexslider.js')}}"></script>
    <div class="box-slide">
        <section class="slider">
            <div class="flexslider" id="bigslideshow">
                <ul class="slides">
                    @foreach($banners as $banner)
                        <li>
                            <a href="javascript: void(0)" target=""><img src="{{$banner}}" alt="slide 6" width="100%" style="display:block"/></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <script type="text/javascript">
            $(function(){
                $('#bigslideshow').flexslider({
                    animation: "slide",
                    slideshowSpeed: 5000,
                    animationDuration: 600,
                    start: function(slider){}
                });
            });
        </script>
    </div>
@endsection

@section('content')
<div class="">
    <div class="page-home">
        <div class="grid">
            <div class="pos-re">
                <a href="index.html#" class="scroll-prev scroll-prev-page"></a>
                <a href="index.html#" class="scroll-next scroll-next-page"></a>
                <div class="swiper-container" id="pagehome">
                    <div class="swiper-wrapper pd-page-home">
                        @foreach($categories as $category)
                            @if(in_array($category->slug, ['dich-vu-chuyen-nha', 'chuyen-nha-tron-goi', 'taxi-tai', 'chuyen-van-phong']))
                            <div class="swiper-slide hvr-float">
                                <div class="box-page-home">
                                    <a href="{{ route('categories.posts.index', $category->slug) }}"><img class="icon-page-home" src="{{ $category->thumbnail }}"></a>
                                    <div class="box-shadow">
                                        <h2 class="page-name-home"><a href="{{ route('categories.posts.index', $category->slug) }}">{{ $category->name }}</a></h2>
                                        <div class="intro-page">
                                            {{ $category->description }}
                                        </div>
                                        <a class="view-detail-page" href="{{ route('categories.posts.index', $category->slug) }}">Xem thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <script>
                var nnpview=3;
                var nsp=30;
                if($(document).width()<=980){
                    var nnpview = 3;
                    var nsp=30;
                }
                if($(document).width()<=768){
                    var nnpview = 2;
                    var nsp=20;
                }

                if($(document).width()<=480){
                    var nnpview = 1;
                    var nsp=10;
                }
                var mySwiper = new Swiper('#pagehome',{
                    pagination: '',
                    paginationClickable: true,
                    slidesPerView: nnpview,
                    loop: true,
                    speed: 400,
                    autoplay:6000,
                    spaceBetween: nsp,
                    nextButton: '.scroll-next-page',
                    prevButton: '.scroll-prev-page'

                })
            </script>

        </div>
    </div>
    <div class="inner-wc-home">
        <div class="wc-home">
            <div class="grid">
                <div class="flex-container flex-container-space-between">
                    <div class="cell-1-2 pad-cell-1-2 mobile-cell-1-1">
                        <div class="box-info-home">
                            <h1 class="title-info-home"><a href="https://chuyennhathanhtam.vn/gioi-thieu/gioi-thieu-chung.html">Công ty chuyển nhà trọn gói Tín Phát Express</a></h1>
                            <div class="content">
                                Nhắc đến dịch vụ chuyển nh&agrave; trọn g&oacute;i tại TPHCM chắc hẳn ai cũng biết đến dịch vụ chuyển nh&agrave; trọn g&oacute;i Tín Phát.&nbsp;<br />
                                Ch&iacute;nh những gi&aacute; trị, lợi &iacute;ch từ dịch vụ chuyển nh&agrave; - chuyển văn ph&ograve;ng - cho thu&ecirc; xe taxi tải mang lại gi&uacute;p kh&aacute;ch h&agrave;ng chuyển h&agrave;ng h&oacute;a, t&agrave;i sản từ nơi ở cũ sang nơi ở mới nhanh ch&oacute;ng - thuận tiện hơn.&nbsp;<br />
                                <br />
                                Tín Phát&nbsp;lu&ocirc;n tự h&agrave;o l&agrave; nh&agrave; cung cấp dịch vụ Vận tải h&agrave;ng h&oacute;a &ndash; Dịch vụ Chuyển nh&agrave; &ndash; Văn ph&ograve;ng trọn g&oacute;i H&agrave;ng đầu tại Việt Nam.<br />
                                &nbsp;
                                <div class="c"></div>
                            </div>
                            <a class="btn-wc" href="https://chuyennhathanhtam.vn/gioi-thieu/gioi-thieu-chung.html">Xem chi tiết <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="cell-1-2 pad-cell-1-2 mobile-cell-1-1 adv-home">
                        <div class="item-adv">
                            <a class="img" href="index.html#" target=""><img src="uploaded/why/kinh-nghiem-lau-na.png" alt="Kinh nghiệm lâu năm"></a>
                            <div class="title-adv"><a href="index.html">Kinh nghiệm lâu năm</a></div>
                        </div>
                        <div class="item-adv">
                            <a class="img" href="index.html#" target=""><img src="uploaded/why/d%23U1ecbch-vu-chuyen-nghiep.png" alt="Dịch vụ chuyên nghiệp"></a>
                            <div class="title-adv"><a href="index.html">Dịch vụ chuyên nghiệp</a></div>
                        </div>
                        <div class="item-adv">
                            <a class="img" href="index.html#" target=""><img src="uploaded/why/xe-cho-27-7.png" alt="Xe chuyên chở phục vụ 24/7"></a>
                            <div class="title-adv"><a href="index.html">Xe chuyên chở phục vụ 24/7</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($categories as $category)
        @if(in_array($category->slug, ['dich-vu-chuyen-nha', 'goc-tu-van', 'chuyen-nha-tron-goi']))
            <div class="line-home">
                <div class="grid">
                    <h2 class="title-home"><a href="{{ route('categories.posts.index', $category->slug) }}">{{ \Illuminate\Support\Str::upper($category->name) }}</a></h2>
                    <div class="flex-container flex-container-space-between">
                        @foreach($category->posts()->where('priority', false)->limit(4)->orderBy('id', 'desc')->get() as $post)
                            <div class="cell-1-4 pad-cell-1-4 tab-cell-1-3 mobile-cell-1-1">
                                <div class="item-news-home">
                                    <a href="{{ route('post.show', $post->slug) }}"><img src="{{ $post->thumbnail }}" alt="{{ $post->name }}" width="100%"></a>
                                    <h3><a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a></h3>
                                    <div class="intro">{{ $post->description }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="bg-14b0bf">
        <div class="grid pos-re">
            <div class="flex-container flex-container-space-between">
                <div class="cell-1-4 mobile-cell-1-1">
                    <div class="hd-review">
                        <div class="inner-hd">
                            <a href="/khach-hang-noi-ve-chung-toi/">KHÁCH HÀNG <br /> NÓI GÌ VỀ <br /> CHÚNG TÔI</a>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <div class="cell-3-4 mobile-cell-1-1">
                    <div class="swiper-container" id="reviewhome">
                        <div class="swiper-wrapper pd-page-home">
                            @foreach($reviews as $review)
                            <div class="swiper-slide">
                                <div class="review-item">
                                    <a class="img" href="/khach-hang-noi-ve-chung-toi/nguyen-thi-hong-nhung.html"><img src="{{ $review->thumbnail }}" alt="{{$review->name}}" width="100%"></a>
                                    <div class="info-review">
                                        <div class="bg-line">
                                            <div class="review-name">{{$review->name}}</div>
                                            <div>Khách hàng</div>
                                        </div>
                                        <div class="review">
                                            {{$review->content}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <script>
                    var mySwiper = new Swiper('#reviewhome',{
                        pagination: '.swiper-pagination',
                        paginationClickable: true,
                        slidesPerView:1,
                        loop: true,
                        speed: 400,
                        autoplay:6000,
                        spaceBetween: 10,
                        nextButton: '.scroll-next-page',
                        prevButton: '.scroll-prev-page'

                    })
                </script>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
