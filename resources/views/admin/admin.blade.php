<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="/favicon.svg">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/favicon.svg" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/favicon.svg" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Trang quản trị - chuyennhatinphat.vn</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('img/logo.png') }}" />
    </a>

    <!-- Links -->
    <ul class="navbar-nav">
        @foreach($categories as $category)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $category->name }}</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.categories.posts.index', $category->id) }}">Danh sách</a>
                    <a class="dropdown-item" href="{{ route('admin.categories.posts.create', $category->id) }}">Thêm mới</a>
                </div>
            </li>
        @endforeach
        <li class="nav-item dropdown">
            <a class="nav-link  dropdown-toggle" data-toggle="dropdown">Cài đặt</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.settings.banners') }}">Banners</a>
                <a class="dropdown-item" href="{{ route('admin.settings.information') }}">Thông tin</a>
                <a class="dropdown-item" href="{{ route('admin.categories.index') }}">Mô tả dịch vụ</a>
                <a class="dropdown-item" href="{{ route('admin.reviews.index') }}">Đánh giá khách hàng</a>
            </div>
        </li>
    </ul>
</nav>
@yield('content')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
