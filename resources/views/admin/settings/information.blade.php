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
        <form action="{{ route('admin.settings.update.information') }}" method="POST">
            <div class="row">
                @method('PUT')
                {{ csrf_field() }}
                @foreach($information as $key => $info)
                <div class="col-12">
                    @if($key == 0) <label>Địa chỉ công ty:</label> @endif
                    @if($key == 1) <label>Số điện thoại:</label> @endif
                    @if($key == 2) <label>Địa chỉ email:</label> @endif
                    <input type="text" class="form-control" name="information[]" required value="{{$info}}">
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 pt-4">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
@endsection