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

Route::get('users', 'UserController@getUsers');
Route::get('publications', 'PublicationController@getPublications');
Route::get('publications/{publication}', 'PublicationController@getPublication');
Route::get('comments', 'CommentController@getComments');

Route::middleware(['auth:api'])->group(function () {
    Route::post('comments', 'CommentController@addComment');
	Route::get('publications/user/{users}', 'UserController@getPublicationUser');
});

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('login', 'Auth\LoginController@login');

    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', 'Auth\LoginController@logout');
    });
});
