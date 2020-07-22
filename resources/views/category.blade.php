<?php
use App\Category;
?>
@extends('app')

@section('title', $category['name'])
@section('metaName')
    <meta name="description" content="{{ strip_tags($category['name']) }}"/>
@endsection
@section('jsonLd')
    @if(!empty($category->parentCategory))
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 2,
            "name": "<?=/** @var Category $category */
            $category['name'] ?>",
            "item": "<?= request()->url() ?>"
          },{
            "@type": "ListItem",
            "position": 1,
            "name": "Trang chủ",
            "item": "<?=env('APP_URL')?>"
          }]
        }
    </script>
    @endif
@endsection

@section('content')
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(count($category->posts) > 0)
                        <div class="blog__details__new__post">
                            <div class="blog__details__new__post__title">
                                <h4>{{$category->name}}</h4>
                            </div>
                            <div class="row">
                                @foreach($posts = $category->posts()->paginate(10) as $post)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic set-bg" data-setbg="{{ $post->thumbnail }}"></div>
                                            <div class="blog__item__text">
                                                <h5><a href="{{ route('post.show', $post->slug) }}">{{ $post->name }}</a></h5>
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
                            @if($posts instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                                <div class="pagination-box pt-5 pb-5">
                                    <div class="col-md-12">
                                        <div class="pull-center">{{ $posts->links('vendor.custom-pager') }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__recent d-flex flex-column">
                            <h5>{{$advisoryPosts[0]->category->name}}</h5>
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
