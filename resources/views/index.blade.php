@extends('app')

@section('title')
    Chuyển nhà trọn gói, chuyển văn phòng, cho thuê taxi tải.
@endsection
@section('metaName')
    <meta name="description" content="Với hơn 15 + Năm kinh nghiệm phục vụ trong lĩnh vực vận chuyển cung cấp giải pháp, phục vụ dịch vụ chuyển nhà trọn gói, chuyển văn phòng trọn gói, cho thuê xe tải vận chuyển chuyên nghiệp số 1 TPHCM. Chỉ từ 140k bạn đã có thể sử dụng được dịch vụ chuyển nhà trọn gói chuyên nghiệp tại Tín Phát Express" />
    <meta name="keywords" content="Chuyển nhà, chuyển văn phòng, taxi tải">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
@endsection
@section('jsonLd')
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "url": "<?=request()->url()?>",
        "name": "Tín Phát Express - Dịch vụ chuyển nhà, chuyển nhà trọn gói, cho thuê taxi tải, chuyển văn phòng.",
        "description": "Với hơn 15 + Năm kinh nghiệm phục vụ trong lĩnh vực vận chuyển cung cấp giải pháp, phục vụ dịch vụ chuyển nhà trọn gói, chuyển văn phòng trọn gói, cho thuê xe tải vận chuyển chuyên nghiệp số 1 TPHCM. Chỉ từ 140k bạn đã có thể sử dụng được dịch vụ chuyển nhà trọn gói chuyên nghiệp tại Tín Phát Express."
    }
    </script>
@endsection

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($banners as $key => $banner)
            <div class="carousel-item @if($key == 0) active @endif">
                <img class="d-block w-100" src="{{ $banner }}" alt="First slide">
            </div>
            @endforeach
        </div>
    </div>
    <section class="news-post spad">
        <div class="container">
            @foreach($categories as $category)
                @if(in_array($category->slug, ['dich-vu-chuyen-nha', 'goc-tu-van', 'chuyen-nha-tron-goi']))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>{{ $category->name }}</h2>
                            <p>{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($category->posts()->limit(3)->orderBy('id', 'desc')->get() as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="blog__item">
                                <div class="blog__item__pic set-bg" data-setbg="{{ $post->thumbnail }}" style="background-image: url({{ $post->thumbnail }});"></div>
                                <div class="blog__item__text">
                                    <h5 style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                        "><a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a></h5>
                                    <span style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 4;
                                            -webkit-box-orient: vertical;
                                        ">{{ $post->description }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- Testimonial Section Begin -->
    <section class="testimonial spad" style="background-color: #72d4dd;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Được tin tưởng hơn 5000+ khách hàng</h2>
                        <p>Khách hàng nói gì về TÍN PHÁT</p>
                    </div>
                    <div class="testimonial__slider owl-carousel">
                        @foreach($reviews as $key => $review)
                        <div class="testimonial__item" data-hash="review-{{ $key }}">
                            <p>"{{ $review->content }}"</p>
                            <div class="testimonial__item__author">
                                @if($key == 0)
                                    <a href="#review-2">
                                        <img src="{{ $reviews[2]->thumbnail }}">
                                    </a>
                                    <a href="#review-0" class="active">
                                        <img src="{{ $reviews[0]->thumbnail }}">
                                    </a>
                                    <a href="#review-1">
                                        <img src="{{ $reviews[1]->thumbnail }}">
                                    </a>
                                @endif
                                @if($key == 1)
                                    <a href="#review-0">
                                        <img src="{{ $reviews[0]->thumbnail }}">
                                    </a>
                                    <a href="#review-1" class="active">
                                        <img src="{{ $reviews[1]->thumbnail }}">
                                    </a>
                                    <a href="#review-2">
                                        <img src="{{ $reviews[2]->thumbnail }}">
                                    </a>
                                @endif
                                @if($key == 2)
                                    <a href="#review-1">
                                        <img src="{{ $reviews[1]->thumbnail }}">
                                    </a>
                                    <a href="#review-2" class="active">
                                        <img src="{{ $reviews[2]->thumbnail }}">
                                    </a>
                                    <a href="#review-0">
                                        <img src="{{ $reviews[0]->thumbnail }}">
                                    </a>
                                @endif
                            </div>
                            <div class="testimonial__item__author__text">
                                <h5>{{ $review->name }}</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->
@endsection