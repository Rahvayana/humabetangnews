<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\News;
use App\NewsCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UsersAdminController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admin = User::where('status_delete', 0)->paginate(10);

        return view('dashboard.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.create');
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
            'name'                      => 'required|min:4',
            'email'                     => 'required|unique:users|email',
            'img'                       => 'required',
            'password'                  => 'required|min:8|same:password_confirmation',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if ($request->hasFile('img')) {
            $validator = Validator::make($request->all(), [
                'img' => 'required|mimes:jpg,jpeg,png|max:2024'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $img_url = $request->file('img')->store('public/uploads/avatar', ['disk' => 'public']);
        }else{
            $img_url = '';
        }

        $admin = new User([
            'name' => $request->name,
            'email' => $request->email,
            'status_active' => 1,
            'status_delete' => 0,
            'password' =>  Crypt::encrypt($request->password),
            'img'      => $img_url,
        ]);

        if($admin->save()){
            return redirect('/dashboard/admin/'.$admin->id)->with('success', 'Success adding admin');

        }else{
            return redirect()->back()->with('error', 'Fail adding admin');
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
        $admin = User::find($id);
        return view('dashboard.admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);

        return view('dashboard.admin.edit', compact('admin'));
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
        $admin = User::find($id);

        $validator = Validator::make($request->all(), [
            'name'                      => 'required|min:4',
            'email'                     => 'unique:users,email,'.$admin->id.',id',
            'password'                  => 'required|min:8|same:password_confirmation',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $img_url = $admin->img;
        if ($request->hasFile('img')) {

            $validator = Validator::make($request->all(), [
                'img' => 'required|mimes:jpg,jpeg,png|max:2024'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            $img_url = $request->file('img')->store('public/uploads/avatar', ['disk' => 'public']);
        }

        $status = $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'status_active' => 1,
            'status_delete' => 0,
            'password' =>  Crypt::encrypt($request->password),
            'img'      => $img_url,
        ]);

        if($status){
            return redirect('/dashboard/admin/'.$admin->id)->with('success', 'Success updating admin');

        }else{
            return redirect('/dashboard/admin/'.$admin->id)->with('success', 'Success updating admin');

        }




    }

        /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $admin = User::find($request->id);
        $admin->status_active = $request->status;
        if($admin->save()){
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
        $admin = User::find($id);
        if($admin->update(['status_delete'=> 1])){
            return redirect()->back()->with('success', 'Success deleting admin');
        }else{
            return redirect()->back()->with('error', 'Fail deleting admin');

        }
    }
}
