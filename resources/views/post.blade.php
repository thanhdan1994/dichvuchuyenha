@extends('app')

@section('title', $post->name . ' | Tín Phát Express' )
@section('head')
    <meta name="description" content="{{ strip_tags($post->description) }}"/>
    <meta property="og:type" content="product"/>
    <meta property="og:title" content="{{ $post->name }}"/>
    <meta property="og:description" content="{{ strip_tags($post->description) }}"/>
    <meta property="og:image" content="{{ $post->thumbnail }}"/>
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
<div class="main-content">
    <div class="crumb hide-on-mobile">
        <div class="grid bb">
            <a href="/">Trang chủ</a>
            <a href="{{ route('categories.posts.index', $post->category->slug) }}">{{$post->category->name}}</a>&nbsp;<i class="fa fa-angle-right"></i>&nbsp;
            <a href="{{ route('post.show', $post->slug) }}">{{$post->name}}</a>
        </div>
    </div>
    <div class="grid">
        <div class="flex-container">
            <div class="cell-1-4 leftpage">
                <div class="box-left">
                    <ul class="menuleft">
                        @foreach($categories as $category)
                            @if($category->id == $post->category_id)
                            <li class="active">
                                <a href="{{route('categories.posts.index', $category->slug)}}">{{$category->name}}</a>
                                <ul>
                                    @foreach($category->posts()->where('priority', true)->limit(10)->orderBy('id', 'desc')->get() as $post)
                                        <li><a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                                <li><a href="{{route('categories.posts.index', $category->slug)}}">{{$category->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="c20"></div>
                <div class="c10"></div>
                <h2 class="title-left bgblue"><a href="javascript: void(0)">Góc tư vấn</a></h2>
                <div class="box-border-left">
                    @foreach($advisoryPosts as $post)
                        <div class="item-news-left">
                            <a href="{{ route('post.show', $post->slug) }}">{{$post->name}} </a>
                        </div>
                    @endforeach
                </div>
                <div class="c10"></div>
                <h2 class="title-left bgblue"><a href="javascript: void(0)">Bài viết liên quan</a></h2>
                <div class="box-border-left">
                    @foreach($relatedPosts as $post)
                        <div class="item-news-left">
                            <a href="{{ route('post.show', $post->slug) }}">{{$post->name}} </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="cell-3-4 rightpage">
                <h1 class="page-name"><span>{{$post->name}}</span></h1>
                <div class="c15"></div>
                <div class="content-detail">{!! $post->content !!}</div>
                <div class="c20"></div>
                <div class="c20"></div>
            </div>
        </div>
    </div>
</div>
@endsection
