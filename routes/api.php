<?php

use Illuminate\Http\Request;

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

//后台
Route::post('/config','ConfigController@getConfig');//获取配置
Route::post('/upload/flash','UploadController@flash');//上传flash图片
Route::post('/upload/logo','UploadController@logo');//上传logo图片
Route::post('/ad/insert','AdController@insert');//增加广告

//首页
Route::post('/index','IndexController@getIndex');//获取首页信息

//目录
Route::post('/menu/create','MenuController@create');//创建目录
Route::post('/menu/product','MenuController@getProduct');//获取商品分类
//新闻
Route::post('/news','NewsController@getList');//获取新闻目录
Route::post('/news/insert','NewsController@insert');//插入新闻
Route::post('/news/detail','NewsController@detail');//新闻详情


//产品
Route::post('/product/insert','ProductController@insert');//插入产品
Route::post('/product','ProductController@getList');//插入产品