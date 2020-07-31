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
        <input type="hidden" name="routeUploadFile" value="{{ route('api.uploads.file') }}">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="was-validated" enctype="multipart/form-data">
            @method('PUT')
            {{ csrf_field() }}
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label>Dịch vụ:</label>
                                <input type="text" class="form-control" name="name" readonly value="{{$category->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả dịch vụ:</label>
                        <textarea class="form-control" rows="3" name="description">{{$category->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <input type="hidden" class="bannerUrl" name="thumbnail" value="{{ $category->thumbnail }}"/>
                                <input type="file" name="file" style="display: none"/>
                                <img class="img-thumbnail js--banners" src="{{$category->thumbnail}}" alt="chọn ảnh" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <a class="btn btn-danger" href="{{ route('admin.categories.index') }}">Hủy bỏ</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('.js--banners').click(function(){
            let bannerInput = $(this).siblings('.bannerUrl');
            let imageElement = $(this);
            $(this).siblings('input[name=file]').trigger('click').on('change', function (event) {
                const formData = new FormData();
                formData.append('file', event.target.files[0]);
                fetch($('input[name=routeUploadFile]').val(), {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(bannerInput);
                        bannerInput.val(data.banner);
                        imageElement.attr('src', data.banner);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
