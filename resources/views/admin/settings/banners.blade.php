@extends('admin.admin')

@section('content')
    <div class="container pt-4 pb-4">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
        @endif
        <input type="hidden" name="routeUploadFile" value="{{ route('api.uploads.file') }}">
        <form action="{{ route('admin.settings.update.banners') }}" method="POST">
            <div class="row">
                @method('PUT')
                {{ csrf_field() }}
                @foreach($banners as $banner)
                    <div class="col-4">
                        <input type="hidden" class="bannerUrl" name="banners[]" value="{{ $banner }}"/>
                        <input type="file" name="file" style="display: none"/>
                        <img class="img-thumbnail js--banners" src="{{$banner}}" />
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 pt-4">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
        </form>
        <div class="row pt-4">
            <span style="color: red">*</span><i>Vui lòng chọn ảnh có kích thước 1366x680.</i>
        </div>
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
