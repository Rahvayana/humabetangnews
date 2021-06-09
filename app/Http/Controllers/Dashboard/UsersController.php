<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\MasterUsers;
use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = MasterUsers::paginate(10);
     
        
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = MasterUsers::find($id);
        return view('dashboard.users.show', compact('user'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
      
    }


        /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $user = MasterUsers::find($request->id);
        $user->status = $request->status;
        if($user->save()){
            return response()->json(['success'=>'Status change successfully.']);
        }else{
            return response()->json(['error'=>'Status change faled.']);

        }
  
    }
}
