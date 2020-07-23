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
            <tbody>
            @foreach($reviews as $key => $review)
                <tr>
                    <th scope="row">{{$review->name}}</th>
                    <th scope="row"><img src="{{$review->thumbnail}}" style="width: 200px; height: 150px" /></th>
                    <th scope="row">{{$review->content}}</th>
                    <td><a class="btn btn-success mb-2" href="{{route('admin.reviews.edit', $review->id)}}">Sửa đánh giá</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection