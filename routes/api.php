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

Route::group(['prefix' => 'v1'], function () {

    Route::post('/login', 'Api\V1\AuthController@login');



    Route::get('/news', 'Api\V1\NewsController@news');
    Route::get('/news-paginate', 'Api\V1\NewsController@newsPaginate');

    Route::get('/slideshow', 'Api\V1\NewsController@slideshow');
    Route::get('/news/category', 'Api\V1\NewsController@newsCategory');
    Route::get('/news/category/{id_category}', 'Api\V1\NewsController@newsCategories');
    Route::get('/detail-news/{id_news}', 'Api\V1\NewsController@detailNews');
    Route::get('/comment/news/{id_news}', 'Api\V1\NewsController@getComment');

    Route::get('/tv', 'Api\V1\TvStreamingController@tv');
    Route::get('/detail-tv/{id_tv}', 'Api\V1\TvStreamingController@detailTv');
    Route::get('/historychat/{id_tv}', 'Api\V1\TvStreamingController@historyChat');

    Route::get('/ads', 'Api\V1\AdvertisementController@ads');

    Route::post('/guest/set/views', 'Api\V1\NewsController@setGuestViews');

    Route::post('/firebase/token', 'Api\V1\FirebaseController@fcmToken');





    //Users
    Route::group(['middleware' => 'auth:api'], function () {

        Route::post('/news/set/likes', 'Api\V1\NewsController@setLikes');
        Route::post('/news/set/bookmark', 'Api\V1\NewsController@setBookmarks');
        Route::post('/news/set/views', 'Api\V1\NewsController@setViews');



        Route::post('/comment/add', 'Api\V1\NewsController@addComment');
        Route::post('/comment/delete', 'Api\V1\NewsController@deleteComment');

        Route::get('/user/news', 'Api\V1\NewsController@userNews');
        Route::get('/user/news-paginate', 'Api\V1\NewsController@userNewsPaginate');


        Route::post('/sendchat', 'Api\V1\TvStreamingController@sendChat');

    });

});
