<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//all articles
Route::get('articles', 'ArticleController@index');
// get data of an article
Route::get('article/{id}', 'ArticleController@show');
// create a new article
Route::post('article', 'ArticleController@store');
// up date article
Route::put('article/{id}', 'ArticleController@update');
// delete article
Route::delete('article/{id}', 'ArticleController@destroy');