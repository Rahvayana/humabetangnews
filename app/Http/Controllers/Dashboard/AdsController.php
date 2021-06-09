<?php

namespace App\Http\Controllers\Dashboard;

use App\Advertisement;
use App\Helpers\Helper;
use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ads = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 0)->paginate(10);



        return view('dashboard.advertisement.index', compact('ads'))->with('success', 'all list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('dashboard.advertisement.create');
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
            'name'         => 'required|min:4',
            'description'   => 'required',
            'img' => 'required|mimes:jpg,jpeg,png|max:2024',
            'link' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }


        $img_url = $request->file('img')->store('public/uploads/ads', ['disk' => 'public']);

        $ads = new Advertisement([
            'ads_name' => $request->name,
            'ads_description' => $request->description,
            'ads_status_active' => 1,
            'ads_img' => $img_url,
            'ads_link' => $request->link,
        ]);

        if($ads->save()){
            return redirect('/dashboard/ads/'.$ads->id)->with('success', 'Success adding Ads');

        }else{
            return redirect()->back()->with('error', 'Fail adding Ads');
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
        $ads = Advertisement::find($id);
        return view('dashboard.advertisement.show', compact('ads'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ads = Advertisement::find($id);

        return view('dashboard.advertisement.edit', compact('ads'));
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
            'name'         => 'required|min:4',
            'description'   => 'required',

            'link' => 'required|min:10',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $ads = Advertisement::find($id);
        $img_url = $ads->ads_img;

        if ($request->hasFile('img')) {
            $validator = Validator::make($request->all(), [
                'img' => 'required|mimes:jpg,jpeg,png|max:2024'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $img_url = $request->file('img')->store('public/uploads/ads', ['disk' => 'public']);
        }

        $ads = Advertisement::find($id);

        $ads->update([
            'ads_name' => $request->name,
            'ads_description' => $request->description,
            'ads_status_active' => 1,
            'ads_img' => $img_url,
            'ads_link' => $request->link,
        ]);

        return redirect('/dashboard/ads/'.$ads->id)->with('success', 'Success updating ads');


    }

        /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $ads = Advertisement::find($request->id);
        $ads->ads_status_active = $request->status;
        if($ads->save()){
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['error'=>'Status change faled.']);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $ads = Advertisement::find($id);
        if($ads->update(['ads_status_delete'=> 1])){
            return redirect()->back()->with('success', 'Success deleting ads');
        }else{
            return redirect()->back()->with('error', 'Fail deleting ads');

        }
    }
}
