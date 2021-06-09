<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids as VinklaHashids;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Models\Master_player_banks;
use App\Models\History_ip_logins;
use App\Helpers\Gamexyz;
use App\MasterUsers;
use App\News;
use App\NewsCategory;
use App\NewsUserBookmark;
use App\NewsUserComent;
use App\NewsUserLike;
use App\NewsUserView;
// use App\Master_app_configuration;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
// use Pusher\Pusher;
use GuzzleHttp\Client;
use Hashids\Hashids;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Json;
use Smsglobal\RestApiClient2\ApiKey;
use Smsglobal\RestApiClient2\Resource\Sms;
use Smsglobal\RestApiClient2\RestApiClient;

class NewsController extends Controller
{


      /**
     * @OA\Get(path="/api/v1/news",
     *   tags={"Public News"},
     *   summary="List news ",
     *   description="",
     *   operationId="listNews",
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function news(Request $request)
    {



        $news  = News::where('news_status_delete', 0)
		    ->with('authors')
		    ->withCount([
                        'likes',
                        'views',
                        'comments' => function ($query) {
                            $query->where('status_delete_coment', 0);
                        }])
                    ->orderBy('news_publish_datetime', 'desc')
                    ->get();


        foreach ($news as $item){
            $item->news_content = $item->getAbbreviatedContentAttribute();
            $item->news_img     = url('').'/'.$item->news_img;
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

         /**
     * @OA\Get(path="/api/v1/news-paginate",
     *   tags={"Public News"},
     *   summary="List news ",
     *   description="",
     *   operationId="listNewsPaginate",
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function newsPaginate(Request $request)
    {



	$news  = News::where('news_status_delete', 0)
		    ->with('authors')
                    ->withCount([
                        'likes',
                        'views',
                        'comments' => function ($query) {
                            $query->where('status_delete_coment', 0);
                        }])
                    ->orderBy('news_publish_datetime', 'desc')
                    ->paginate(7);


        foreach ($news as $item){
            $item->news_content = $item->getAbbreviatedContentAttribute();
            $item->news_img     = url('').'/'.$item->news_img;
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

          /**
     * @OA\Get(path="/api/v1/detail-news/{id_news}",
     *   tags={"Public News"},
     *   summary="detail news",
     *   description="",
     *   operationId="detailNews",
     *   @OA\Parameter(
     *     name="id_news",
     *     in="query",
     *     @OA\Schema(
     *         type="int",
     *     ),
     *     description="detail news",
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function detailNews(Request $request)
    {

        $user =  auth()->guard('api')->user();

        $news = News::with('authors')->find($request->id_news);


        $news->news_content = ([
            'rendered' => $news->news_content
        ]);
        $news->news_img = url('').'/'.$news->news_img;
        $news->news_link = url('').'/berita/'.$news->news_slug;

        $news->authors->img = url('').'/'.$news->authors->img;

        if(!isset($news)){
            return response()->json([
                'status' => 'error',
                'data' => 'news not found'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

            /**
     * @OA\Get(path="/api/v1/news/category/{id_category}",
     *   tags={"Public News"},
     *   summary="List news by category",
     *   description="",
     *   operationId="listNewsByCategory",
     *   @OA\Parameter(
     *     name="id_category",

     *     in="query",
     *     @OA\Schema(
     *         type="int",
     *     ),
     *     description="list news by category",
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function newsCategories(Request $request)
    {

        if($request->id_category == 0){
            $news = News::where('news_status_delete', 0)
            ->get();
        }else{
            $news = News::where('category_id', $request->id_category)->where('news_status_delete', 0)
            ->get();
        }

        foreach ($news as $item){
            $item->news_content = $item->getAbbreviatedContentAttribute();
            $item->news_img     = url('').'/'.$item->news_img;
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

              /**
     * @OA\Get(path="/api/v1/news/category",
     *   tags={"Public News"},
     *   summary="List news category",
     *   description="",
     *   operationId="listNewsCategory",
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function newsCategory(Request $request)
    {

        $news = NewsCategory::where('news_categories_status_delete', 0)->orderBy('news_categories_order', 'asc')->get();

        foreach($news as $item){

            // $item[] = $item;
            $item->news_categories_app_img = url('/').$item->news_categories_app_img;
            $item->news_categories_web_img = url('/').$item->news_categories_web_img;

        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);

    }

        /**
     * @OA\Get(path="/api/v1/user/news",
     *   tags={"News"},
     *   summary="List news by user",
     *   description="",
     *   operationId="listNewsByUser",
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function userNews(Request $request)
    {
        $user =  auth()->guard('api')->user();

        $news  = News::where('news_status_delete', 0)
                        ->withCount([
                            'likes as status_likes' => function ($query)use($user) {
                                $query->where('users_id', $user->id);
                            },
                            'views as status_views'=> function ($query)use($user) {
                                $query->where('users_id', $user->id);
                            },
                            'comments as status_comment' => function ($query)use($user) {
                                $query->where('status_delete_coment', 0);
                                $query->where('users_id', $user->id);
                            }])
                        ->orderBy('news_publish_datetime', 'desc')
                        ->get();

        foreach ($news as $item){
            $item->news_content = $item->getAbbreviatedContentAttribute();
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

            /**
     * @OA\Get(path="/api/v1/user/news-paginate",
     *   tags={"News"},
     *   summary="List news by user",
     *   description="",
     *   operationId="listNewsByUserPaginate",
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function userNewsPaginate(Request $request)
    {
        $user =  auth()->guard('api')->user();

        $news  = News::where('news_status_delete', 0)
                        ->withCount([
                            'likes as status_likes' => function ($query)use($user) {
                                $query->where('users_id', $user->id);
                            },
                            'views as status_views'=> function ($query)use($user) {
                                $query->where('users_id', $user->id);
                            },
                            'comments as status_comment' => function ($query)use($user) {
                                $query->where('status_delete_coment', 0);
                                $query->where('users_id', $user->id);
                            }])
                        ->orderBy('news_publish_datetime', 'desc')
                        ->paginate(7);

        foreach ($news as $item){
            $item->news_content = $item->getAbbreviatedContentAttribute();
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

    /**
     * @OA\Post(path="/api/v1/news/set/likes",
     *   tags={"News"},
     *   summary="set likes/dislike on news",
     *   description="",
     *   operationId="likeNews",
     *   @OA\Parameter(
     *     name="id_news",
     *     required=true,
     *     in="query",
     *     description="news id",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *    @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="0 = Dislike, 1 = like",
     *         required=true,
     *         @OA\Schema(
     *         type="array",
     *           @OA\Items(
     *              type="int",
     *              enum={0, 1},
     *              default="0"
     *           ),
     *         ),
     *         style="form"
     *     ),
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function setLikes(Request $request)
    {

        $user =  auth()->guard('api')->user();
        $status_like = NewsUserLike::where('news_id', $request->id_news)->where('users_id', $user->id)->first();

        // return $status_like;

        //already likes
        if(isset($status_like)){

            if($request->type == 0){

                if($status_like->delete()){
                    $news = News::find($request->id_news);


                    return response()->json([
                        'status' => 'success',
                        'message' => 'Dislike news',
                        'data' => $news

                    ], 200);
                }

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Dislike fail'
                ], 400);

            }else{

                return response()->json([
                    'status' => 'error',
                    'message' => 'Already likes'
                ], 400);
            }

        }else{

            if($request->type == 0){

                return response()->json([
                    'status' => 'error',
                    'message' => 'Not likes yet'
                ], 400);

            }else{

                $likes = new NewsUserLike([
                    'news_id' => $request->id_news,
                    'users_id'=> $user->id
                ]);

                if($likes->save()){
                    $news = News::find($request->id_news);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Likes news success',
                        'data' => $news

                    ], 200);

                }else{

                    return response()->json([
                        'status' => 'error',
                        'data' => 'likes news fail'
                    ], 400);

                }

            }
        }

    }

        /**
     * @OA\Post(path="/api/v1/news/set/views",
     *   tags={"News"},
     *   summary="set status views on news",
     *   description="",
     *   operationId="setViews",
     *   @OA\Parameter(
     *     name="id_news",
     *     required=true,
     *     in="query",
     *     description="news id",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function setViews(Request $request)
    {

        $user =  auth()->guard('api')->user();
        $status_view = NewsUserView::where('news_id', $request->id_news)->where('users_id', $user->id)->first();

        // return $status_view;

        //already likes
        if(isset($status_view)){

                return response()->json([
                    'status'  => 'success',
                    'message' => 'Already viewed'
                ], 200);

        }else{


                $view = new NewsUserView([
                    'news_id' => $request->id_news,
                    'users_id'=> $user->id
                ]);

                if($view->save()){
                    $news = News::find($request->id_news);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'success view',
                        'data' => $news
                    ], 200);

                }else{

                    return response()->json([
                        'status' => 'error',
                        'data' => 'view news fail'
                    ], 400);

                }


        }

    }

            /**
     * @OA\Post(path="/api/v1/guest/set/views",
     *   tags={"Guest"},
     *   summary="set status views on news for guest",
     *   description="",
     *   operationId="setViewsGuest",
     *   @OA\Parameter(
     *     name="id_news",
     *     required=true,
     *     in="query",
     *     description="news id",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function setGuestViews(Request $request)
    {

                $view = new NewsUserView([
                    'news_id' => $request->id_news,
                    'users_id'=> 3
                ]);

                if($view->save()){
                    $news = News::find($request->id_news);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'success view',
                        'data' => $news
                    ], 200);

                }else{

                    return response()->json([
                        'status' => 'error',
                        'data' => 'view news fail'
                    ], 400);

                }

    }

     /**
     * @OA\Post(path="/api/v1/news/set/bookmark",
     *   tags={"News"},
     *   summary="set bookmark/unbookmark",
     *   description="",
     *   operationId="bookmarkNews",
     *   @OA\Parameter(
     *     name="id_news",
     *     required=true,
     *     in="query",
     *     description="news id",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *    @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="0 = Unbookmark, 1 = Bookmark",
     *         required=true,
     *         @OA\Schema(
     *         type="array",
     *           @OA\Items(
     *              type="int",
     *              enum={0, 1},
     *              default="0"
     *           ),
     *         ),
     *         style="form"
     *     ),
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function setBookmarks(Request $request)
    {

        $user =  auth()->guard('api')->user();
        $status_bookmark = NewsUserBookmark::where('news_id', $request->id_news)->where('users_id', $user->id)->first();

        // return $status_bookmark;

        //already likes
        if(isset($status_bookmark)){

            if($request->type == 0){

                if($status_bookmark->delete()){

                    $news = News::find($request->id_news);

                    return response()->json([
                        'status'  => 'success',
                        'message' => 'Unbooked news',
                        'data' => $news
                    ], 200);

                }

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Bookmark fail'
                ], 400);

            }else{

                return response()->json([
                    'status' => 'error',
                    'message' => 'Already Booked'
                ], 400);

            }

        }else{

            if($request->type == 0){

                return response()->json([
                    'status' => 'error',
                    'message' => 'Not bookmark yet'
                ], 400);

            }else{

                $bookmark = new NewsUserBookmark([
                    'news_id' => $request->id_news,
                    'users_id'=> $user->id
                ]);

                if($bookmark->save()){

                    $news = News::find($request->id_news);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Bookmark news success',
                        'data' => $news
                    ], 200);

                }else{

                    return response()->json([
                        'status' => 'error',
                        'data' => 'Bookmark news fail'
                    ], 400);

                }
            }
        }
    }


          /**
     * @OA\Get(path="/api/v1/slideshow",
     *   tags={"Slideshow"},
     *   summary="List slidshow ",
     *   description="",
     *   operationId="listSlideshow",
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function slideshow(Request $request)
    {

        $news = News::where('news_status_delete', 0)->where('news_status_slideshow', 1)->get();


        foreach ($news as $item){
            $item->news_content = $item->getAbbreviatedContentAttribute();
            $item->news_img     = url('').'/'.$item->news_img;
        }

        return response()->json([
            'status' => 'success',
            'data' => $news
        ], 200);
    }

    /**
     * @OA\Post(path="/api/v1/comment/add",
     *   tags={"Coment"},
     *   summary="addComent",
     *   description="",
     *   operationId="addComent",
     *   @OA\Parameter(
     *     name="id_news",
     *     required=true,
     *     in="query",
     *     description="news id",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="text_comment",
     *     required=true,
     *     in="query",
     *     description="text coment",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function addComment(Request $request)
    {

        $user =  auth()->guard('api')->user();
        // $comment = NewsUserComent::where('news_id', $request->id_news)->where('users_id', $user->id)->first();


        $view = new NewsUserComent([
            'news_id' => $request->id_news,
            'users_id'=> $user->id,
            'text_coment'=> $request->text_comment

        ]);

        if($view->save()){
            $news = News::find($request->id_news);

            return response()->json([
                'status' => 'success',
                'message' => 'success add Comment',
            ], 200);

        }else{

            return response()->json([
                'status' => 'error',
                'data' => 'fail add Comment'
            ], 400);

        }





    }

    /**
     * @OA\Post(path="/api/v1/comment/delete",
     *   tags={"Coment"},
     *   summary="delete coment",
     *   description="",
     *   operationId="deleteComent",
     *   @OA\Parameter(
     *     name="id_coment",
     *     required=true,
     *     in="query",
     *     description="news id",
     *     @OA\Schema(
     *         type="string"
     *     )
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     *   security={{
     *     "Authorization":{}
     *   }}
     * )
     */
    public function deleteComment(Request $request)
    {

        $user =  auth()->guard('api')->user();
        $comment = NewsUserComent::where('id', $request->id_coment)->where('users_id', $user->id)->first();

        if(!isset($comment)){

            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found',
            ], 400);
        }

        if($comment->update(['status_delete_coment' => 1])){

            return response()->json([
                'status' => 'success',
                'message' => 'Comment deleted',
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Fail delete comment',
            ], 400);
        }





    }

    /**
     * @OA\Get(path="/api/v1/comment/news/{id_news}",
     *   tags={"Public News"},
     *   summary="get comment by id news",
     *   description="",
     *   operationId="lits coment by id news",
     *   @OA\Parameter(
     *     name="id_news",

     *     in="query",
     *     @OA\Schema(
     *         type="int",
     *     ),
     *     description="list coment by id_news",
     *   ),
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function getComment(Request $request)
    {

        $user =  auth()->guard('api')->user();
        $comments = NewsUserComent::with(array('users'=>function($query){
            $query->select('id','username', 'picture');
        }))
        ->where('news_id', $request->id_news)->where('status_delete_coment', 0)->get();


        return response()->json([
            'status' => 'success',
            'message' => 'get coment success',
            'data' => $comments
        ], 200);
    }

}
