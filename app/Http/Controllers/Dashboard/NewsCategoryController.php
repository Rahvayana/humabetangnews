<?php

namespace App\Http\Controllers\Dashboard;

use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class NewsCategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $categories = NewsCategory::where('news_categories_status_delete', 0)->orderBy('news_categories_order', 'asc')->get();

        return view('dashboard.news_categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('dashboard.news_categories.create');

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
            // 'mobile_icon' => 'required|mimes:jpg,jpeg,png|max:2024',
            // 'web_icon' => 'required|mimes:jpg,jpeg,png|max:2024',
            'name' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        if ($request->hasFile('mobile_icon')) {
            $mobile_icon = $request->file('mobile_icon')->store('public/uploads/mobile/icons', ['disk' => 'public']);

        }
        if ($request->hasFile('web_icon')) {
            $web_icon = $request->file('web_icon')->store('public/uploads/web/icons', ['disk' => 'public']);

        }


        $category = new NewsCategory([
            'news_categories_name'      => $request->name,
            'news_categories_slug'      => Str::slug($request->name, '-'),



            // 'news_categories_app_img'   => $mobile_icon,
            // 'news_categories_web_img'   => $web_icon,
        ]);
        if($category->save()){
            return redirect('dashboard/news-category')->with('success', 'Success adding new category');
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function show(NewsCategory $newsCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = NewsCategory::find($id);
        return view('dashboard.news_categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'mobile_icon' => 'required|mimes:jpg,jpeg,png|max:2024',
            // 'web_icon' => 'required|mimes:jpg,jpeg,png|max:2024',
            'name' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $categories = NewsCategory::find($id);

        $mobile_icon = $categories->news_categories_app_img;
        if ($request->hasFile('mobile_icon')) {
            $mobile_icon = $request->file('mobile_icon')->store('public/uploads/mobile/icons', ['disk' => 'public']);

        }

        $web_icon = $categories->news_categories_web_img;
        if ($request->hasFile('web_icon')) {
            $web_icon = $request->file('web_icon')->store('public/uploads/web/icons', ['disk' => 'public']);

        }

        $categories = NewsCategory::find($id);

        $update = $categories->update([
            'news_categories_name'      => $request->name,
            'news_categories_slug'      => Str::slug($request->name, '-'),

            // 'news_categories_app_img'   => $mobile_icon,
            // 'news_categories_web_img'   => $web_icon,
        ]);

        if($update){

            return redirect('/dashboard/news-category')->with('success', 'Success edit category');
        }

        return redirect()->back()->with('error', 'Update category Fail !');



    }

    public function reorder(Request $request)
    {
        $categories = NewsCategory::where('news_categories_status_delete', 0)->get();


        foreach ($categories as $cat) {
            foreach ($request->order as $order) {
                if ($order['id'] == $cat->id) {
                    $cat->update(['news_categories_order' => $order['position']]);
                }
            }
        }


        return response()->json([
            'status'=> 'success',
            'message'=>'Success reorder categories'
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = NewsCategory::find($id);
        if($category->update(['news_categories_status_delete' => 1])){
            return redirect()->back()->with('success', 'Success deleting category');
        }else{
            return redirect()->back()->with('error', 'Fail deleting category');

        }
    }
}
