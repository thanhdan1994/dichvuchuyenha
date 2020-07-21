@extends('app')

@section('content')
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-2 font-weight-bold" style="font-size: 25px">{{ $post->name }}</h2>
                    <div class="blog__details__text">
                        {!! $post->content !!}
                    </div>
                    @if(count($relatedPosts) >= 2)
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
