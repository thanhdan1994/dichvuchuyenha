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
        <form method="POST" action="{{ route('admin.categories.posts.store', $category->id) }}" class="was-validated" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label>Tên dịch vụ:</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mô tả dịch vụ:</label>
                    <textarea class="form-control" rows="3" name="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label>Nội dung bài viết:</label>
                    <textarea class="form-control" rows="3" name="content" id="editor">{!! old('content') !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện: </label>
                    <input type="file" name="thumbnail" />
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="status" checked />Kích hoạt
                    </label>
                    <label class="form-check-label ml-5">
                        <input type="checkbox" class="form-check-input" name="priority" />Nổi bật
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a class="btn btn-danger" href="{{ route('admin.categories.posts.index', $category->id) }}">Hủy bỏ</a>
            </div>
        </div>
    </form>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                ckfinder: {
                    uploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                    options: {
                        resourceType: 'Images'
                    }
                },
                toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' , 'mediaEmbed' ]
            } )
            .catch( function( error ) {
                console.error( error );
            } );
    </script>
@endsection
