<?php

use App\Category;
use App\Post;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

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

Route::get('/hashpassword', function (Request $request) {
    $password = $request->get('password');
    $hash = \Illuminate\Support\Facades\Hash::make($password);
    echo $hash;
});

Route::get('/', function () {
    $categories = Category::all();
    $banners = DB::table('settings')->where('slug', 'banners')->pluck('value')->first();
    $banners = explode(',', $banners);
    $reviews = DB::table('reviews')->limit(5)->get();
    return view('index', compact('categories', 'banners', 'reviews'));
})->name('index');

Route::get('/gioi-thieu.html', function () {
    $categories = Category::all();
    $advisoryPosts = Post::where(['category_id'=> 6, 'status' => true])->limit(10)->get();
    $priorityPosts = Post::where(['status' => true, 'priority' => true])->limit(10)->get();
    return view('introduce', compact('categories', 'advisoryPosts', 'priorityPosts'));
})->name('introduce');


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

Route::get('/tim-kiem.html', function (Request $request) {
    $categories = Category::all();
    $q = $request->get('q');
    $posts = Post::where('name', 'like', '%'.$q.'%')->where('status', true)->paginate(20);
    return view('search', compact('categories', 'posts'));
})->name('search');

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

    Route::get('/categories', function () {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    })->name('categories.index');

    Route::get('/categories/{category}/edit', function (Category $category) {
        $categories = Category::all();
        return view('admin.categories.edit', compact('category', 'categories'));
    })->name('categories.edit');

    Route::put('/categories/{category}', function (Request $request, Category $category) {
        DB::beginTransaction();
        try {
            $category->description = $request->get('description');
            $category->save();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.categories.index')->with('error', 'Có lỗi khi cập nhật mô tả dịch vụ!' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật mô tả dịch vụ thành công!');
    })->name('categories.update');

    Route::get('/reviews', function () {
        $categories = Category::all();
        $reviews = Review::all();
        return view('admin.reviews.index', compact('categories', 'reviews'));
    })->name('reviews.index');

    Route::get('/reviews/{review}/edit', function (Review $review) {
        $categories = Category::all();
        return view('admin.reviews.edit', compact('review', 'categories'));
    })->name('reviews.edit');

    Route::put('reviews/{review}', function (\App\Requests\UpdateReviewRequest $request, Review $review) {
        $data = $request->except(['_method', '_token', 'thumbnail']);
        if ($request->file('thumbnail')) {
            $path = $request->file('thumbnail')->store('reviews', 'public');
            $data['thumbnail'] = '/storage/' . $path;
        }
        DB::beginTransaction();
        try {
            foreach ($data as $key => $value) :
                $review->$key = $value;
            endforeach;
            $review->save();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.reviews.index')->with('error', 'Cập nhật nội dung đánh giá thất bại ' . $exception->getMessage());
        }
        DB::commit();
        return redirect()->route('admin.reviews.index')->with('success', 'Cập nhật nội dung đánh giá thành công');
    })->name('reviews.update');

    Route::get('/categories/{category}/posts', function (Request $request, Category $category) {
        $categories = Category::all();
        $posts = Post::where('category_id', $category->id)->paginate(10);
        return view('admin.posts.index', compact('categories', 'posts'));
    })->name('categories.posts.index');

    Route::get('/categories/{category}/posts/create', function (Request $request, Category $category) {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'category'));
    })->name('categories.posts.create');

    Route::post('/categories/{category}/posts', function (\App\Requests\CreatePostRequest $request, Category $category) {
        $data = $request->except(['_method', '_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->status ? true : false;
        $data['priority'] = $request->priority ? true : false;
        $data['category_id'] = $category->id;
        if ($request->file('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
            $data['thumbnail'] = '/storage/' . $path;
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
            $path = $request->file('thumbnail')->store('uploads/thumbnail', 'public');
            $data['thumbnail'] = '/storage/' . $path;
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

    Route::get('/users/{user}', function (Request $request, User $user) {
        $categories = Category::all();
        return view('admin.users.edit', compact('categories', 'user'));
    })->name('users.edit');

    Route::put('/users/{user}', function (\App\Requests\UpdateUserPasswordRequest $request, User $user) {
        if (\Illuminate\Support\Facades\Hash::check($request->oldPassword, $user->password)) {
            DB::beginTransaction();
            try {
                $user->fill([
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password)
                ])->save();
            } catch (Exception $exception) {
                DB::rollBack();
                return redirect()->route('admin.users.edit', 1)->with('error', 'Có lỗi khi <strong>đổi mật khẩu</strong> ' . $exception->getMessage());
            }
            DB::commit();
            return redirect()->route('admin.users.edit', $user->id)->with('success', 'Cập nhật mật khẩu mới thành công!');
        }
        return redirect()->route('admin.users.edit', $user->id)->with('error', 'Mật khẩu cũ của bạn không đúng');
    })->name('users.update');

    Route::get('/create-sitemap', function () {
        $sitemap = SitemapGenerator::create(env('APP_URL'))
            ->getSitemap()
            ->add(Url::create('/')
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.1));
        $categories = Category::all();
        foreach ($categories as $key => $item) {
            $url = env('APP_URL') . '/chuyen-muc-bai-viet/' . $item->slug . '.html';
            $sitemap->add(Url::create($url)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.1));
        }

        $posts = \App\Post::where('status', true)->get();
        foreach ($posts as $key => $item) {
            $url = env('APP_URL') . '/bai-viet/' . $item->slug . '.html';
            $sitemap->add(Url::create($url)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }


        $sitemapContent = $sitemap->writeToFile(public_path('sitemap.xml'));
        return $sitemapContent;
    })->name('sitemap.create');
});
