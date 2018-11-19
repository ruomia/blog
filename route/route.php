<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});
Route::get('hello/:name', 'index/hello');

// 完全匹配
// Route::get('category','admin/Category/index');
// Route::get('category/create','admin/Category/create');

// 后台
// Route::group([],function(){
//     Route::get('admin', 'admin/Index/index');
Route::get('admin/login','admin/Login/login');
Route::post('admin/login','admin/Login/store');
Route::get('admin/logout','admin/Login/logout');
// })->middleware('Login');
Route::get('admin/:name', 'admin/Index/:name');
// Route::get('admin/[:name]', 'admin/index')->pattern(['name' => '\w+']);
// Route::get('admin/main','admin/Index/main');
Route::resource('category','admin/category');
Route::resource('article','admin/article');

// Route::get('admin/category', '/category');
Route::get('content/:id','index/content');
Route::get('about','index/about');

return [

];
