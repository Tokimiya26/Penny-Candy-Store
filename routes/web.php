<?php

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

//トップページ
Route::get('/', 'ItemController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//商品詳細ページを表示
Route::get('/item/{item}', 'ItemController@show');

//商品出店ページを表示
Route::get('/postitem', 'PostItemController@index');
Route::post('/postitem', 'PostItemController@store');

//カートに追加、数量変更
Route::post('/cartitem', 'CartItemController@store');

//カート一覧を表示
Route::get('/cartitem', 'CartItemController@index');

//カートの更新
Route::put('/cartitem/{cartItem}', 'CartItemController@update');

//カートから削除
Route::delete('/cartitem/{cartItem}', 'CartItemController@destroy');

//お気に入りに追加
Route::post('/favoriteitem', 'FavoriteItemController@store');

//お気に入り一覧を表示
Route::get('/favoriteitem', 'FavoriteItemController@index');

//お気に入りから削除
Route::delete('/favoriteitem/{favoriteItem}', 'FavoriteItemController@destroy');

//購入画面
Route::get('/buy', 'BuyController@index');
Route::post('/buy', 'BuyController@store');

//購入履歴に追加
Route::post('/orderitem', 'OrderItemController@store');

//購入履歴一覧を表示
Route::get('/orderitem', 'OrderItemController@index');

//注文をキャンセル
Route::delete('/orderitem/{orderItem}', 'OrderItemController@destroy');
