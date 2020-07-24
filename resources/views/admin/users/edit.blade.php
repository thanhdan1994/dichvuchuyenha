@extends('admin.admin')

@section('content')
    <div class="container pt-4 pb-4">
        @if($errors->all())
            @foreach($errors->all() as $message)
                <div class="box no-border">
                    <div class="box-tools">
                        <p class="alert alert-warning alert-dismissible">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </p>
                    </div>
                </div>
            @endforeach

        @elseif(session()->has('success'))
            <div class="box no-border">
                <div class="box-tools">
                    <p class="alert alert-success alert-dismissible">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </p>
                </div>
            </div>
        @elseif(session()->has('error'))
            <div class="box no-border">
                <div class="box-tools">
                    <p class="alert alert-danger alert-dismissible">
                        {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </p>
                </div>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="was-validated" enctype="multipart/form-data">
            @method('PUT')
            {{ csrf_field() }}
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label>Mật khẩu cũ:</label>
                                <input type="password" class="form-control" name="oldPassword" value="{{ old('oldPassword') }}" placeholder="nhập mật khẩu hiện tại của bạn">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label>Mật khẩu mới:</label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="nhập mật khẩu mới">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label>Xác nhận mật khẩu mới:</label>
                                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="nhập lại mật khẩu mới">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a class="btn btn-danger" href="{{ route('admin.categories.posts.index', 1) }}">Hủy bỏ</a>
        </form>
    </div>
@endsection
