<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\News;
use App\NewsCategory;
use App\NewsUserComent;
use App\TvStreaming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Pusher\Pusher;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_news = News::where('news_status_delete', 0)->orderBy('news_publish_datetime', 'desc')->paginate(10);
        $data['all_news'] = $all_news;
        return view('home', $data);
    }

    public function detailBerita($slug){
        $news = News::where('news_slug', $slug)->where('news_status_delete', 0)->where('news_status', 1)->first();

        if(isset($news)){
        $news_related = News::where('category_id', $news->category_id)->where('news_status_delete', 0)->where('news_status', 1)->inRandomOrder()
        ->limit(2)->get();
        }else{
            $news_related = News::where('news_status_delete', 0)->where('news_status', 1)->inRandomOrder()
            ->limit(2)->get();
        }

        $data['news'] = $news;

        $data['news_related'] = $news_related;

        return view('detail', $data);
    }

    public function top10(){
        $all_news = \App\News::where('news_status_delete', 0)
        ->withCount([
            'likes',
            'views',
            'comments' => function ($query) {
                $query->where('status_delete_coment', 0);
            }])
        ->orderBy('likes_count', 'desc')
        ->orderBy('views_count', 'desc')
        ->orderBy('comments_count', 'desc')
        ->take(10)->get();


        // return $all_news;

        $data['all_news'] = $all_news;
        return view('top10', $data);
    }

    public function newsByKategori($slug){

        // $categories = Categories::whereHas('products', function ($query) use ($searchString){
        //     $query->where('name', 'like', '%'.$searchString.'%');
        // })
        // ->with(['products' => function($query) use ($searchString){
        //     $query->where('name', 'like', '%'.$searchString.'%');
        // }])->get();

        $all_news = News::whereHas('category', function ($query) use ($slug){
            $query->where('news_categories_slug', 'like', '%'.$slug.'%');
        })
        ->where('news_status_delete', 0)->orderBy('news_publish_datetime', 'desc')->paginate(10);
        $data['all_news'] = $all_news;



        $data['kategori'] = NewsCategory::where('news_categories_slug', $slug)->first();

        return view('news_by_category', $data);

    }

    public function tvOnline(){

        $tv_list = TvStreaming::where('tv_status_delete', 0)->where('tv_status_active', 1)->get();
        $data['tv_list'] = $tv_list;

        return view('streaming', $data);
    }

    public function imageResizer($id){
        $news = News::find($id);

        $src = '';
        if(isset($news)){
            $src = $news->news_img;
        }

       $cacheimage = \Image::cache(function($image) use ($src) {
        //    return $image->make($src)->resize(100,75, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->encode('jpg', 75);
        return $image->make($src)->crop(200,200);
       }, 10, true);

       return Response::make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
    }

    public function privacyPolicy()
    {
        return view('privacy_policy');
    }

    public function termsOfService()
    {
        return view('terms_condition');
    }
}
