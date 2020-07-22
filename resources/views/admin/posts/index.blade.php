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
                <th scope="col">Mã bài viết</th>
                <th scope="col">Tên bài</th>
                <th scope="col">Ảnh</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $key => $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->name}}</td>
                    <td><img width="150px" height="100px" src="{{$post->thumbnail}}" /></td>
                    <td>
                        <a class="btn btn-success mb-2" href="{{route('admin.posts.edit', $post->id)}}">Sửa bài viết</a>
                        <form method="post" action="{{route('admin.posts.destroy', $post->id)}}"
                              onsubmit="return confirm('Bạn chắc chắn muốn xóa bài viết này?');">
                            {{method_field('delete')}}
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-danger">Xóa bài viết</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
@endsection
