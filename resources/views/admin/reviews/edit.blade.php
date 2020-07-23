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

        @elseif(session()->has('message'))
            <div class="box no-border">
                <div class="box-tools">
                    <p class="alert alert-success alert-dismissible">
                        {{ session()->get('message') }}
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
        <form method="POST" action="{{ route('admin.reviews.update', $review->id) }}" class="was-validated" enctype="multipart/form-data">
            @method('PUT')
            {{ csrf_field() }}
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label>Tên người đánh giá:</label>
                                <input type="text" class="form-control" name="name" value="{{$review->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nội dung đánh giá:</label>
                        <textarea class="form-control" rows="3" name="content">{{$review->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Ảnh đại diện: </label>
                        <input type="file" name="thumbnail" />
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <a class="btn btn-danger" href="{{ route('admin.reviews.index') }}">Hủy bỏ</a>
                </div>
            </div>
        </form>
    </div>
@endsection