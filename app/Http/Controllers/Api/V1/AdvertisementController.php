<?php

namespace App\Http\Controllers\Api\V1;

use App\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

      /**
     * @OA\Get(path="/api/v1/ads",
     *   tags={"Advertisments"},
     *   summary="Ads",
     *   description="",
     *   operationId="getAds",
     *   @OA\Response(response="default", description="successful operation"),
     * )
     */
    public function ads()
    {
        $count = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 0)->count();

        if($count > 1){
            $ads = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 0)->get()->random();
        }else{
            $ads = Advertisement::where('ads_status_delete', 0)->where('ads_status_web', 0)->first();
        }

        if(isset($ads)){
            $ads->ads_img = url('/').'/'.$ads->ads_img;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'success get ads',
            'data' => $ads
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, advertisement $advertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(advertisement $advertisement)
    {
        //
    }
}
