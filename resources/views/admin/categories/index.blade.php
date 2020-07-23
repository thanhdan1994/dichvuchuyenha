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
        <table class="table table-striped text-center">
            <thead>
            <tr>
                <th scope="col">Tên dịch vụ</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key => $category)
                <tr>
                    <th scope="row">{{$category->name}}</th>
                    <td><a class="btn btn-success mb-2" href="{{route('admin.categories.edit', $category->id)}}">Sửa mô tả</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection