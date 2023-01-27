<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChienDichController;
use App\Http\Controllers\BlackListController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\KeyGoogleController;
use App\Http\Controllers\KeyYoutubeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UrlController;

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

Route::controller(ChienDichController::class)->group(function () {
    // Chiến dịch
    // Route::get('/rd/xml/a/tool-clone', 'parseURL');
    Route::get('/rd/xml/a/get-cam', 'getCam');
    Route::post('/rd/xml/a/save-cam', 'saveCam');
    Route::post('/rd/xml/a/delete-campaign', 'deleteCam');
    Route::post('/rd/xml/a/delete-all-campaign', 'deleteAllCam');
    Route::get('/rd/xml/a/update-cam/{id_campaign}', 'updateStatusCam');
    Route::get('/rd/xml/a/reset-cam/{id_campaign}', 'resetStatusCam');
});

Route::controller(KeyController::class)->group(function () {
    Route::get('/rd/xml/a/get-key', 'getKey');
    Route::get('/rd/xml/a/get-key-by-id-cam/{id_cam}','getKeyByIdCam');
    Route::post('/rd/xml/a/save-key', 'saveKey');
    Route::post('/rd/xml/a/save-key-by-id-cam/{id_cam}', 'saveKeyByIdCam');
    Route::get('/rd/xml/a/update-key/{id_key}', 'updateKey');
    Route::get('/rd/xml/a/find-key/{name}', 'findLikeKey');
    Route::get('/rd/xml/a/reset-key/{id_key}', 'resetKey');
    Route::post('/rd/xml/a/delete-key', 'xoaKey');
    Route::post('/rd/xml/a/delete-all-key/{id_cam}', 'xoaAllKeyByIdCam');
    Route::get('/rd/xml/a/get-id-key/{id_cam}', 'getIdKey');
});

Route::controller(UrlController::class)->group(function () {
    Route::post('/rd/xml/a/save-url/{id_key}', 'saveUrl')->name('save_url');
    Route::get('/rd/xml/a/delete-url/{id_url}', 'xoaURL')->name('xoaURL');
    Route::get('/rd/xml/a/get-url/{id_key}', 'getUrl')->name('get-url');
    Route::get('/rd/xml/a/get-url-by-id/{id_url}', 'getUrlById')->name('get-url-by-id');
    Route::get('/rd/xml/a/get-url-by-id-key/{id_key}', 'getUrlByIdKey')->name('get-url-by-id-key');
    Route::get('/rd/xml/a/get-url-by-id-key2/{id_key}', 'getUrlByIdKey2')->name('get-url-by-id-key2');
    Route::get('/rd/xml/a/find-like-url/{name}', 'findLikeUrl')->name('findLikeUrl');
    Route::get('/rd/xml/a/reset-url/{id_key}', 'resetUrl')->name('reset-url');
    Route::get('/rd/xml/a/delete-url-by-id-key/{id_key}', 'xoaURLByIdKey')->name('xoaURLByIdKey');
});


Route::controller(BlackListController::class)->group(function () {
    Route::get('/rd/xml/a/get-black-list-by-id-cam/{id_cam}', 'getBlackListByIdCam');
    Route::post('/rd/xml/a/save-black-list-by-id-cam/{id_cam}', 'saveBlackListByIdCam');
    Route::post('/rd/xml/a/delete-black-list', 'deleteBlackKey');
    Route::post('/rd/xml/a/delete-all-black-list/{id_cam}', 'deleteAllBlackKeyByIdCam');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/rd/xml/a/delete-post-by-id-key/{id_key}', 'xoaPostByIdKey');
    Route::get('/rd/xml/a/save-image-by-id-key/{id_key}', 'saveImgByKey');
    Route::get('/rd/xml/a/get-bai-viet-all', 'getBaiVietAll')->name('get-bv-all');
    Route::get('/rd/xml/a/get-detail-post/{id}', 'getDetailPost')->name('get-bv-all');
});

// Route::get('/rd/xml/a/create_toplist/{id}', 'Admin\ToolCloneController@taoBaiTH')->name('create_toplist');


// Route::get('/rd/xml/a/get-key-none-url/{id_cam}','Admin\ToolCloneController@getKeyNoneUrl');
// Route::post('/rd/xml/a/save-key-by-id-cam/{id_cam}', 'Admin\ToolCloneController@saveKeyByIdCam')->name('save_key_by_id_cam');

// Route::get('/rd/xml/a/get-count-check-url-by-id-cam/{id_cam}','Admin\ToolCloneController@getCountCheckURLByIdCam');
// Route::post('/rd/xml/a/save-video', 'Admin\ToolCloneController@saveVideo')->name('save_video');
// Route::get('/rd/xml/a/check-video/{id_key}', 'Admin\ToolCloneController@checkVideo')->name('checkVideo');

// // Api post tool v2

// Route::get('/rd/xml/a/get-data-id-have-video/{id_key}','Admin\ToolCloneController@getDataIdHaveVideo');
// Route::get('/rd/xml/a/get-data-id-have-url-google/{id_key}','Admin\ToolCloneController@getDataIdHaveUrlGoogle');

Route::controller(KeyGoogleController::class)->group(function () {
    Route::get('/rd/xml/a/get-all-key-google', 'getAllKeyGoogle');
    Route::get('/rd/xml/a/get-key-google', 'getValidKeyGoogle');
    Route::get('/rd/xml/a/get-next-key-google/{key}', 'getNextKeyGoogle');
    Route::get('/rd/xml/a/get-first-key-google', 'getFirstKeyGoogle');
    Route::post('/rd/xml/a/save-key-google', 'saveKeyGoogle');
    Route::post('/rd/xml/a/delete-key-google', 'deleteKeyGoogle');
    Route::post('/rd/xml/a/delete-all-key-google', 'deleteAllKeyGoogle');
    Route::get('/rd/xml/a/update-count-key-google/{key_gg}', 'updateCountKeyGoogle');
    Route::post('/rd/xml/a/reset-all-key-google', 'resetAllKeyGoogle');
});

// Route::get('/rd/xml/a/get-ky-hieu/{id_key}','Admin\ToolCloneController@getKyHieu');
// Route::post('/rd/xml/a/save-web', 'Admin\ToolCloneController@saveWeb')->name('save_web');
// Route::post('/rd/xml/a/save-video', 'Admin\ToolCloneController@saveVideo')->name('save_video');
// Route::post('/rd/xml/a/save-image', 'Admin\ToolCloneController@saveImage')->name('save_image');
// Route::post('/rd/xml/a/save-file', 'Admin\ToolCloneController@saveFileType')->name('save_file');
// Route::get('/rd/xml/a/update-count-key-google/{key}', 'Admin\ToolCloneController@updateCountKeyGoogle');
// Route::get('/rd/xml/a/get-key-google', 'Admin\ToolCloneController@getKeyGoogle');
// Route::get('/rd/xml/a/get-next-key-google/{key}', 'Admin\ToolCloneController@getNextKeyGoogle');
// Route::get('/rd/xml/a/get-first-key-google', 'Admin\ToolCloneController@getFistKeyGoogle');
// Route::get('/rd/xml/a/get-all-key-google', 'Admin\ToolCloneController@getAllKeyGoogle');
// Route::post('/rd/xml/a/save-key-google', 'Admin\ToolCloneController@saveKeyGoogle')->name('save_key_google');
// Route::get('/rd/xml/a/delete-key-google/{id_key_gg}', 'Admin\ToolCloneController@deleteKeyGoogle')->name('delete_key_google');

Route::controller(KeyYoutubeController::class)->group(function () {
    Route::get('/rd/xml/a/get-key-youtube', 'getKeyYoutube');
    Route::get('/rd/xml/a/get-all-key-youtube', 'getAllKeyYoutube');
    Route::post('/rd/xml/a/save-key-youtube', 'saveKeyYoutube');
    Route::post('/rd/xml/a/delete-key-youtube', 'deleteKeyYoutube');
    Route::post('/rd/xml/a/delete-all-key-youtube', 'deleteAllKeyYoutube');
    Route::post('/rd/xml/a/update-count-key-youtube/{key_yt}', 'updateCountKeyYoutube');
    Route::get('/rd/xml/a/get-next-key-youtube/{key}', 'getNextKeyYoutube');
    Route::get('/rd/xml/a/get-first-key-youtube', 'getFirstKeyYoutube');
    Route::post('/rd/xml/a/reset-all-key-youtube', 'resetAllKeyYoutube');
    Route::post('/rd/xml/a/update-vi-tri/{id_key}', 'updateViTri');
    Route::post('/rd/xml/a/update-count-request/{count_y}/{count_g}/{id_key}', 'updateCountRequest');
    Route::get('/rd/xml/a/get-total-request/{id_cam}', 'getTotalRequest');
});

// Route::get('/rd/xml/a/export/{from}/{to}/{id_cam}','Admin\ToolCloneController@export_js');
// Route::get('/rd/xml/a/export_txt/{from}/{to}/{id_cam}','Admin\ToolCloneController@export_txt_rd');
// Route::get('/rd/xml/a/export_txt_wiki/{from}/{to}/{id_cam}','Admin\ToolCloneController@export_txt_wiki');

// Route::get('/rd/xml/a/createTH_rd/{from}/{to}/{id_cam}','Admin\ToolCloneController@createTH_rd');
// Route::get('/rd/xml/a/createTH_wiki/{from}/{to}/{id_cam}','Admin\ToolCloneController@createTH_wiki');
// Route::get('/rd/xml/a/createTH_wiki_new/{from}/{to}/{id_cam}/{chon}','Admin\ToolCloneController@createTH_wiki_new');
// Route::get('/rd/xml/a/createTH_xds/{from}/{to}/{id_cam}','Admin\ToolCloneController@createTH_xds');
