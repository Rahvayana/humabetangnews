<?php

namespace App\Http\Controllers\Dashboard;

use App\ConfigApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends AdminController
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
     * edit the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit()
    {
        $config = ConfigApp::first();


        return view('dashboard.settings', compact('config'));
    }

      /**
     * update the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'web_app_name'      => 'required|min:4',
            'description_meta'  => 'required|min:4',
            'keyword_meta'      => 'required|min:4',
            'authors_meta'      => 'required|min:4',
            'footer'            => 'required|min:4',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $config = ConfigApp::first();
        $logo = $config->logo;

        if ($request->hasFile('logo')) {
            $validator = Validator::make($request->all(), [
                'logo' => 'required|mimes:jpg,svg,jpeg,png|max:2024'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $logo = $request->file('logo')->store('public/uploads/config', ['disk' => 'public']);
        }
        $logo_text = $config->logo_text;
        if ($request->hasFile('logo_text')) {
            $validator = Validator::make($request->all(), [
                'logo_text' => 'required|mimes:jpg,svg,jpeg,png|max:2024'
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $logo_text = $request->file('logo_text')->store('public/uploads/config', ['disk' => 'public']);
        }


        $update = $config->update([
            'logo' => $logo,
            'logo_text' => $logo_text,
            'web_app_name' => $request->web_app_name,
            'description_meta' => $request->description_meta,
            'keyword_meta' => $request->keyword_meta,
            'authors_meta' => $request->authors_meta,
            'footer' => $request->footer,
        ]);

        if($update){
            return redirect()->back()->with('success', 'Success updating settings');

        }else{
            return redirect()->back()->with('error', 'Fail updating settings');

        }

    }
}
