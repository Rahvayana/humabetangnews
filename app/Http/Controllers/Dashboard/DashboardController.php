<?php

namespace App\Http\Controllers\Dashboard;

use App\FcmTokens;
use App\MasterUsers;
use App\News;
use App\NewsCategory;
use App\NewsUserView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $tokens = FcmTokens::all();

        // $recipients = [];
        // foreach($tokens as $token){
        //     $recipients[] = $token->tokens;
        // }


        // fcm()
        // ->to($recipients) // $recipients must an array
        // ->priority('high')
        // ->timeToLive(0)
        // ->data([
        //     'news_id' => 1,
        // ])
        // ->notification([
        //     'title' => 'Berita terbaru !',
        //     'body'  => 'Ini berita baru',
        // ])
        // ->send();



        $data['news_count'] = News::where('news_status_delete', 0)->count();
        $data['categories_count'] = NewsCategory::where('news_categories_status_delete', 0)->count();
        $data['users_count'] = MasterUsers::count();
        $data['view_today_count'] = NewsUserView::whereDate('created_at', date('Y-m-d'))->count();
        $data['news'] = News::where('news_status_delete', 0)->paginate(10);


        return view('dashboard.dashboard', $data);
    }
}
