<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/uploads/file', function (Request $request) {
    $banner = '';
    if ($request->file('file')) {
        try {
            $path = $request->file('file')->store('img/banners', 'without_storage');
            $banner = env('APP_URL') . $path;
        } catch (Exception $exception) {
            abort(500, 'Lỗi không thể upload image' . $exception->getMessage());
        }
    }
    return response(['banner' => $banner], 200);
})->name('api.uploads.file');
