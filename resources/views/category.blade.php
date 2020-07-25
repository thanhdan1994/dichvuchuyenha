@extends('app')

@section('title', $category['name'])
@section('head')
    <meta name="description" content="{{ strip_tags($category['name']) }}"/>
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
@endsection

@section('content')
<div class="main-content">
    @if(count($category->posts) > 0)
        <div class="line-home">
            <div class="grid">
                <h2 class="title-home"><a href="{{ route('categories.posts.index', $category->slug) }}">{{ \Illuminate\Support\Str::upper($category->name) }}</a></h2>
                <div class="flex-container flex-container-space-between">
                    @foreach($category->posts()->orderBy('id', 'desc')->get() as $post)
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
</div>
@endsection
