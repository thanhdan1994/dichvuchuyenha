@extends('app')

@section('title', $post->name . ' | chuyennhatinphat.vn' )
@section('metaName')
    <meta name="description" content="{{ strip_tags($post->description) }}"/>
    <meta property="og:type" content="product"/>
    <meta property="og:title" content="{{ $post->name }}"/>
    <meta property="og:description" content="{{ strip_tags($post->description) }}"/>
    @if(!is_null($post->cover))
        <meta property="og:image" content="{{ $post->thumbnail }}"/>
    @endif
@endsection

@section('jsonLd')
    <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key=c2b2fc7ddc097c556e1050"></script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 3,
            "name": "<?=$post->name ?>",
            "item": "<?=request()->url()?>"
          },{
            "@type": "ListItem",
            "position": 2,
            "name": "<?= $post->category->name ?>",
            "item": "<?= env('APP_URL') . '/chuyen-muc-bai-viet' . '/' . $post->category->slug . '.html'?>"
          },{
            "@type": "ListItem",
            "position": 1,
            "name": "Trang chủ",
            "item": "<?=env('APP_URL')?>"
          }]
        }
    </script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "NewsArticle",
          "headline": "<?php echo $post->name ?>",
          "image": [
            "<?php echo $post->thumbnail ?>"
           ],
          "description": "<?=$post->description?>",
          "author" : {
            "@type": "Person",
            "name": "Tín Phát Express"
          }
        }
    </script>
@endsection

@section('content')
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-2 font-weight-bold" style="font-size: 25px">{{ $post->name }}</h2>
                    <div class="blog__details__text">
                        {!! $post->content !!}
                    </div>
                    @if(count($relatedPosts) > 0)
                    <div class="blog__details__new__post">
                        <div class="blog__details__new__post__title">
                            <h4>Dịch vụ liên quan</h4>
                        </div>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                            <div class="col-lg-6 col-md-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic set-bg" data-setbg="{{ $relatedPost->thumbnail }}"></div>
                                    <div class="blog__item__text">
                                        <h5><a href="{{ route('post.show', $relatedPost->slug) }}">{{ $relatedPost->name }}</a></h5>
                                        <span style="
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 4;
                                            -webkit-box-orient: vertical;
                                        ">{{ $relatedPost->description }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__recent">
                            <h5>Góc tư vấn</h5>
                            @foreach($advisoryPosts as $advisoryPost)
                            <a href="{{ route('post.show', $advisoryPost->slug) }}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="{{ $advisoryPost->thumbnail }}" alt="{{ $advisoryPost->name }}">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>{{ $advisoryPost->name }}</h6>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.querySelectorAll('oembed[url]').forEach( element => {
            iframely.load( element, element.attributes.url.value );
        } );
    </script>
@endsection
