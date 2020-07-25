@extends('app')

@section('content')
<div class="main-content">
    <div class="line-home">
        <div class="grid">
            <div class="flex-container flex-container-space-between">
                @foreach($posts as $post)
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
</div>
@endsection
