@extends('admin.admin')

@section('content')
    <div class="container pt-4 pb-4">
        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" class="was-validated" enctype="multipart/form-data">
        @method('PUT')
        {{ csrf_field() }}
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label>Tên sản phẩm:</label>
                            <input type="text" class="form-control" name="name" required value="{{$post->name}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm:</label>
                    <textarea class="form-control" rows="3" name="description">{{$post->description}}</textarea>
                </div>
                <div class="form-group">
                    <label>Nội dung bài viết:</label>
                    <textarea class="form-control" rows="3" name="content" id="editor">{!! $post->content !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Ảnh đại diện: </label>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ $post->thumbnail }}" alt="" class="img-responsive img-thumbnail">
                        </div>
                    </div>
                    <input type="file" name="thumbnail" />
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="status" @if($post->status) checked @endif />Kích hoạt
                    </label>
                    <label class="form-check-label ml-5">
                        <input type="checkbox" class="form-check-input" name="priority" @if($post->priority) checked @endif />Nổi bật
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a class="btn btn-danger" href="{{ route('admin.categories.posts.index', $post->category_id) }}">Hủy bỏ</a>
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
