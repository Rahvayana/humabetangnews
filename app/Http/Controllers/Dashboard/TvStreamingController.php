<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\News;
use App\NewsCategory;
use App\TvSreaming;
use App\TvStreaming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TvStreamingController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tv = TvStreaming::where('tv_status_delete', 0)->paginate(10);


        return view('dashboard.tv.index', compact('tv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.tv.create');
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
            'tv_name'       => 'required|min:4',
            'tv_description'=> 'required|min:4',
            'tv_url_stream' => 'required|min:4',
            'tv_img'        => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $tv_img= '';
        if ($request->hasFile('tv_img')) {
            $tv_img = $request->file('tv_img')->store('public/uploads/mobile/icons', ['disk' => 'public']);
        }


        $tv = new TvStreaming([
            'tv_name' => $request->tv_name,
            'tv_description'=>$request->tv_description,
            'tv_url_stream'=>$request->tv_url_stream,
            'tv_img'=>$tv_img,
        ]);

        if($tv->save()){
            return redirect('/dashboard/tv/'.$tv->id)->with('success', 'Success adding tv');

        }else{
            return redirect()->back()->with('error', 'Fail adding tv');
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
        $tv = TvStreaming::find($id);
        return view('dashboard.tv.show', compact('tv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tv = TvStreaming::find($id);
        return view('dashboard.tv.edit', compact('tv'));
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
            'tv_name'       => 'required|min:4',
            'tv_description'=> 'required|min:4',
            'tv_url_stream' => 'required|min:4',
            'tv_img'        => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }
        $tv_img= '';
        if ($request->hasFile('tv_img')) {
            $tv_img = $request->file('tv_img')->store('public/uploads/mobile/icons', ['disk' => 'public']);
        }


        $tv = TvStreaming::find($id);

        $tv->update([
            'tv_name' => $request->tv_name,
            'tv_description'=>$request->tv_description,
            'tv_url_stream'=>$request->tv_url_stream,
            'tv_img'=>$tv_img,
        ]);

        return redirect('/dashboard/tv/'.$tv->id)->with('success', 'Success updating tv');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tv = TvStreaming::find($id);

        $tv->tv_status_delete = 1;
        if($tv->save()){
            return response()->json(['success'=>'Tv delete successfully.']);
        }else{
            return response()->json(['error'=>'Tv delete failed.']);

        }
    }

            /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $news = TvStreaming::find($request->id);
        $news->tv_status_active = $request->status;
        if($news->save()){
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['error'=>'Status change failed.']);

        }

    }

}
