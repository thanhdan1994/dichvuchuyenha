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

Route::get('/bai-viet/{slug}.html', function (Request $request) {
    $categories = Category::all();
    $post = Post::where('slug', $request->slug)->first();
    $relatedPosts = Post::where('category_id', $post->category_id)->whereNotIn('id', [$post->id])->limit(4)->get();
    $advisoryPosts = Post::where('category_id', 6)->whereNotIn('id', [$post->id])->limit(5)->get();
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

    Route::get('/categories/{category}/posts', function (Request $request, Category $category) {
        $categories = Category::all();
        $posts = Post::where('category_id', $category->id)->paginate(10);
        return view('admin.posts.index', compact('categories', 'posts'));
    })->name('categories.posts.index');

    Route::get('/categories/{category}/posts/create', function (Request $request) {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    })->name('categories.posts.create');

    Route::get('/posts/{post}/edit', function (Post $post) {
        $categories = Category::all();
        return view('admin.posts.edit', compact('categories', 'post'));
    })->name('posts.edit');

    Route::put('/posts/{post}', function (Request $request, Post $post) {
        $data = $request->except(['_method', '_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->status ? true : false;
        $data['priority'] = $request->priority ? true : false;
        if ($request->file('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/thumbnail/' . $post->id, 'without_storage');
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
