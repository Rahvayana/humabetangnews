<?php

namespace App\Http\Controllers\Dashboard;

use App\FcmTokens;
use App\Helpers\Helper;
use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['hasil_kata']                              = '';
        $data['category_id']                             = 0;
        $news = News::where('news_status_delete', 0)->orderBy('news_publish_datetime', 'desc')->paginate(10);
        $data['news']                                    = $news;

        return view('dashboard.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = NewsCategory::where('news_categories_status_delete', 0)->get();
        return view('dashboard.news.create', compact('categories'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|min:4',
            'category_id'   => 'required',
            // 'video_url'     => 'required|min:4',
            'datetime_published' => 'required',
            'content' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if ($request->has('is_slideshow')) {
            $news_status_slideshow = 1;
        }else{
            $news_status_slideshow = 0;
        }



        // if(!$request->has('video_url')){

        //     if ($request->hasFile('img')) {
        //         $validator = Validator::make($request->all(), [
        //             'img' => 'required|mimes:jpg,jpeg,png|max:2024'
        //         ]);

        //         if ($validator->fails()) {
        //             return redirect()->back()->with('error', $validator->errors()->first());
        //         }

        //         $img_url = $request->file('img')->store('public/uploads/news/', ['disk' => 'public']);
        //     }else{
        //         $img_url = '';
        //     }
        // }else{
        //     $img_url = Helper::getYoutubeImgFromURL($request->video_url);
        // }

            if ($request->hasFile('img')) {
                $validator = Validator::make($request->all(), [
                    'img' => 'required|mimes:jpg,jpeg,png|max:2024'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->with('error', $validator->errors()->first());
                }

                $img_url = $request->file('img')->store('public/uploads/news', ['disk' => 'public']);
            }else{
                $img_url = '';
            }

        $news = new News([
            'news_title' => $request->title,
            'news_slug' => Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'admin_id' => Auth::user()->id,
            'news_status' => 1,
            'news_content' => $request->content,
            'news_img' => $img_url,
            'news_video' => $request->video_url,
            'news_status_slideshow' => $news_status_slideshow,
            'news_publish_datetime' => $request->datetime_published
        ]);

        if($news->save()){

            $tokens = FcmTokens::all();

            $recipients = [];
            foreach($tokens as $token){
                $recipients[] = $token->tokens;
            }


            fcm()
            ->to($recipients) // $recipients must an array
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'news_id' => $news->id,
            ])
            ->notification([
                'title' => 'Berita terbaru !',
                'body'  => $news->news_title,
            ])
            ->send();


            return redirect('/dashboard/news/'.$news->id)->with('success', 'Success adding news');

        }else{
            return redirect()->back()->with('error', 'Fail adding news');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('dashboard.news.show', compact('news'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $categories = NewsCategory::where('news_categories_status_delete', 0)->get();
        return view('dashboard.news.edit', compact('categories', 'news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|min:4',
            'category_id'   => 'required',
            'datetime_published' => 'required',
            'content' => 'required|min:10',
        ]);

        if ($request->is_slideshow != null) {
            $news_status_slideshow = 1;
        }else{
            $news_status_slideshow = 0;
        }

        // return $request;

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $news = News::find($id);
        $img_url = $news->news_img;

        if ($request->hasFile('img')) {
            $validator = Validator::make($request->all(), [
                'img' => 'required|mimes:jpg,jpeg,png|max:2024'
            ]);

            // foreach ($this->dimensions as $row) {
            //     //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY
            //     $canvas = Image::canvas($row, $row);
            //     //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY
            //     //DENGAN MEMPERTAHANKAN RATIO
            //     $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
            //         $constraint->aspectRatio();
            //     });

            //     //CEK JIKA FOLDERNYA BELUM ADA
            //     if (!File::isDirectory($this->path . '/' . $row)) {
            //         //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
            //         File::makeDirectory($this->path . '/' . $row);
            //     }

            //     //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            //     $canvas->insert($resizeImage, 'center');
            //     //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            //     $canvas->save($this->path . '/' . $row . '/' . $fileName);
            // }

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $img_url = $request->file('img')->store('public/uploads/news/', ['disk' => 'public']);
        }

        $news = News::find($id);

        $news->update([
            'news_title' => $request->title,
            'news_slug' => Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'news_content' => $request->content,
            'news_img' => $img_url,
            'news_video' => $request->video_url,
            'news_status_slideshow' => $news_status_slideshow,
            'news_publish_datetime' => $request->datetime_published
        ]);

        return redirect('/dashboard/news/'.$news->id)->with('success', 'Success updating news');


    }

        /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $news = News::find($request->id);
        $news->news_status = $request->status;
        if($news->save()){
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['error'=>'Status change faled.']);

        }

    }

    public function search(Request $request){
        $url_sekarang                   = $request->fullUrl();
        $hasil_kata                     = $request->cari_kata;
        $category_id                    = $request->category_id;
        $data['hasil_kata']             = $hasil_kata;

        if($category_id != 0){
            $news = News::where('news_status_delete', 0)->where('category_id', $category_id)->where('news_title', 'like', '%'.$hasil_kata.'%')->orderBy('news_publish_datetime', 'desc')->paginate(10);
        }else{
            $news = News::where('news_status_delete', 0)->where('news_title', 'like', '%'.$hasil_kata.'%')->orderBy('news_publish_datetime', 'desc')->paginate(10);
        }

        $news->appends(['search' => $hasil_kata]);

        $data['news']                   = $news;
        $data['category_id']            = $category_id;




        return view('dashboard.news.index', $data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $news = News::find($id);
        if($news->update(['news_status_delete'=> 1])){
            return redirect()->back()->with('success', 'Success deleting news');
        }else{
            return redirect()->back()->with('error', 'Fail deleting news');

        }
    }
}
