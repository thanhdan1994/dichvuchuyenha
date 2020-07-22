<?php

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $categories = Category::all();
    $banners = DB::table('settings')->where('slug', 'banners')->pluck('value')->first();
    $banners = explode(',', $banners);
    return view('index', compact('categories', 'banners'));
})->name('index');

Route::get('/chuyen-muc-bai-viet/{slug}.html', function (Request $request) {
    $categories = Category::all();
    $category = Category::where('slug', $request->slug)->first();
    $advisoryPosts = Post::where(['category_id'=> 6, 'status' => true])->limit(10)->get();
    if ($category->id == 6) {
        $advisoryPosts = Post::where(['category_id' => rand(1, 5), 'status' => true])->limit(10)->get();
    }
    return view('category', compact('categories', 'category', 'advisoryPosts'));
})->name('categories.posts.index');

Route::get('/bai-viet/{slug}.html', function (Request $request) {
    $categories = Category::all();
    $post = Post::where('slug', $request->slug)->first();
    $relatedPosts = Post::where(['category_id' => $post->category_id, 'status' => true])->whereNotIn('id', [$post->id])->limit(4)->get();
    $advisoryPosts = Post::where('category_id', 6)->whereNotIn('id', [$post->id])->limit(10)->get();
    return view('post', compact('categories', 'post', 'relatedPosts', 'advisoryPosts'));
})->name('post.show');

Route::group(['prefix' => 'administrator', 'middleware' => ['auth.basic'], 'as' => 'admin.' ], function () {
    Route::get('/', function () {
        $categories = Category::all();
        $posts = Post::where('category_id', 1)->paginate(10);
        return view('admin.posts.index', compact('categories', 'posts'));
    })->name('dashboard');

    Route::get('/settings/banners', function () {
        $categories = Category::all();
        $banners = DB::table('settings')->where('slug', 'banners')->pluck('value')->first();
        $banners = explode(',', $banners);
        return view('admin.settings.banners', compact('categories', 'banners'));
    })->name('settings.banners');

    Route::put('settings/banners', function (Request $request) {
        $banners = $request->get('banners');
        DB::beginTransaction();
        try {
            DB::table('settings')
                ->where('slug', 'banners')
                ->update(['value' => implode(',', $banners)]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.settings.banners')->with('error', 'Cập nhật cài đặt banner mới không thành công!'. $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.settings.banners')->with('success', 'Cập nhật cài đặt banner mới thành công!');
    })->name('settings.update.banners');

    Route::get('/settings/information', function () {
        $categories = Category::all();
        $information = DB::table('settings')->where('slug', 'information')->pluck('value')->first();
        $information = explode('|', $information);
        return view('admin.settings.information', compact('categories', 'information'));
    })->name('settings.information');

    Route::put('/settings/information', function (Request $request) {
        $information = $request->get('information');
        DB::beginTransaction();
        try {
            DB::table('settings')
                ->where('slug', 'information')
                ->update(['value' => implode('|', $information)]);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.settings.information')->with('error', 'Cập nhật cài đặt thông tin mới không thành công!'. $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.settings.information')->with('success', 'Cập nhật cài đặt thông tin mới thành công!');
    })->name('settings.update.information');

    Route::get('/categories/{category}/posts', function (Request $request, Category $category) {
        $categories = Category::all();
        $posts = Post::where('category_id', $category->id)->paginate(10);
        return view('admin.posts.index', compact('categories', 'posts'));
    })->name('categories.posts.index');

    Route::get('/categories/{category}/posts/create', function (Request $request, Category $category) {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'category'));
    })->name('categories.posts.create');

    Route::post('/categories/{category}/posts/create', function (\App\Requests\CreatePostRequest $request, Category $category) {
        $data = $request->except(['_method', '_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->status ? true : false;
        $data['priority'] = $request->priority ? true : false;
        $data['category_id'] = $category->id;
        if ($request->file('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/thumbnail', 'without_storage');
            $data['thumbnail'] = env('APP_URL') . $path;
        }
        DB::beginTransaction();
        try {
            $post = Post::create($data);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.categories.posts.index', $post->category_id)->with('error', 'Có lỗi khi <strong>Thêm mới</strong> bài viết thất bại!' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.categories.posts.index', $post->category_id)->with('success', 'Thêm mới bài viết thành công!');
    })->name('categories.posts.store');

    Route::get('/posts/{post}/edit', function (Post $post) {
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories', 'post'));
    })->name('posts.edit');

    Route::put('/posts/{post}', function (\App\Requests\UpdatePostRequest $request, Post $post) {
        $data = $request->except(['_method', '_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->status ? true : false;
        $data['priority'] = $request->priority ? true : false;
        if ($request->file('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/thumbnail', 'without_storage');
            $data['thumbnail'] = env('APP_URL') . $path;
        }
        DB::beginTransaction();
        try {
            foreach ($data as $key => $value) :
                $post->$key = $value;
            endforeach;
            $post->save();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.categories.posts.index', $post->category_id)->with('error', 'Có lỗi khi <strong>CẬP NHẬT</strong> bài viết thất bại!' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.categories.posts.index', $post->category_id)->with('success', 'Cập nhật bài viết thành công!');
    })->name('posts.update');

    Route::delete('/posts/{post}', function (Post $post) {
        DB::beginTransaction();
        try {
            $post->delete();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.categories.posts.index', $post->category_id)->with('error', 'Có lỗi khi <strong>XÓA</strong> bài viết!' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.categories.posts.index', $post->category_id)->with('success', 'Bài viết đã được xóa thành công!');
    })->name('posts.destroy');
});
