<?php

use App\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


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

Route::get('/', 'HomeController@index');
Route::post('/login-auth', 'Auth\LoginController@loginAuth');


Route::get('/berita/{slug}', 'HomeController@detailBerita');

Route::get('/privacy-policy', 'HomeController@privacyPolicy');
Route::get('/terms-of-service', 'HomeController@termsOfService');

// Route::group(['middleware' => ['auth:web'], 'prefix' => 'berita'], function () {


// });

Route::post('/berita/addcomment', 'UsersController@addComment');
Route::get('/top-10', 'HomeController@top10');
Route::get('/berita/kategori/{slug}', 'HomeController@newsByKategori');
Route::get('/tv-online', 'HomeController@tvOnline');

//image resizer
Route::get('/imager/{id}', 'HomeController@imageResizer');

Route::post('/pusher/sendMessage', 'PusherController@sendMessage');



Auth::routes();

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'dashboard'], function () {
    Route::get('/', 'Dashboard\DashboardController@index');

    //news
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'Dashboard\NewsController@index');
        Route::get('/create', 'Dashboard\NewsController@create');
        Route::get('/search', 'Dashboard\NewsController@search');

        Route::post('/store', 'Dashboard\NewsController@store');
        Route::get('/{id}', 'Dashboard\NewsController@show');
        Route::get('/edit/{id}', 'Dashboard\NewsController@edit');
        Route::post('/update/{id}', 'Dashboard\NewsController@update');
        Route::get('/delete/{id}', 'Dashboard\NewsController@delete');
        Route::get('/set/status', 'Dashboard\NewsController@changeStatus');


    });
    //category news
    Route::group(['prefix' => 'news-category'], function () {
        Route::get('/', 'Dashboard\NewsCategoryController@index');
        Route::get('/create', 'Dashboard\NewsCategoryController@create');
        Route::post('/store', 'Dashboard\NewsCategoryController@store');
        Route::get('/edit/{id}', 'Dashboard\NewsCategoryController@edit');
        Route::post('/update/{id}', 'Dashboard\NewsCategoryController@update');
        Route::get('/delete/{id}', 'Dashboard\NewsCategoryController@delete');
        Route::post('/reorder','Dashboard\NewsCategoryController@reorder');
    });

        //category news
        Route::group(['prefix' => 'tv'], function () {
            Route::get('/', 'Dashboard\TvStreamingController@index');
            Route::get('/create', 'Dashboard\TvStreamingController@create');
            Route::post('/store', 'Dashboard\TvStreamingController@store');
             Route::get('/{id}', 'Dashboard\TvStreamingController@show');

            Route::get('/edit/{id}', 'Dashboard\TvStreamingController@edit');
            Route::post('/update/{id}', 'Dashboard\TvStreamingController@update');
            Route::get('/set/status', 'Dashboard\TvStreamingController@changeStatus');
            Route::get('/delete/{id}', 'Dashboard\TvStreamingController@destroy');


        });

        Route::group(['prefix' => 'slideshow'], function () {
            Route::get('/', 'Dashboard\SlideshowController@index');
            Route::get('/{id}', 'Dashboard\SlideshowController@show');
            Route::get('/delete/{id}', 'Dashboard\SlideshowController@delete');

        });

        Route::group(['prefix' => 'ads'], function () {

            Route::get('/{id}', 'Dashboard\AdsController@show');

            Route::get('/create/new', 'Dashboard\AdsController@create');
            Route::post('/store', 'Dashboard\AdsController@store');
            Route::get('/edit/{id}', 'Dashboard\AdsController@edit');

            Route::get('/', 'Dashboard\AdsController@index');
            Route::get('/delete/{id}', 'Dashboard\AdsController@delete');
            Route::post('/update/{id}', 'Dashboard\AdsController@update');
            Route::get('/set/status', 'Dashboard\AdsController@changeStatus');

        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/{id}', 'Dashboard\UsersController@show');
            Route::get('', 'Dashboard\UsersController@index');
            Route::get('/set/status', 'Dashboard\UsersController@changeStatus');
        });

        //category news
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', 'Dashboard\UsersAdminController@index');
            Route::get('/create', 'Dashboard\UsersAdminController@create');
            Route::post('/store', 'Dashboard\UsersAdminController@store');
            Route::get('/{id}', 'Dashboard\UsersAdminController@show');
            Route::get('/edit/{id}', 'Dashboard\UsersAdminController@edit');
            Route::post('/update/{id}', 'Dashboard\UsersAdminController@update');
            Route::get('/set/status', 'Dashboard\UsersAdminController@changeStatus');
            Route::get('/delete/{id}', 'Dashboard\UsersAdminController@delete');
        });

        Route::group(['prefix' => 'settings'], function () {


            Route::get('', 'Dashboard\SettingsController@edit');
            Route::post('update', 'Dashboard\SettingsController@update');

        });
});

