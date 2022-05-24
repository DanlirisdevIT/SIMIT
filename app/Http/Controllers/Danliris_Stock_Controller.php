<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Danliris_Movement;
// use App\Models\Danliris_Permintaan;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Danliris_Stock_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $danliris_movements = Danliris_Movement::with(['assets', 'categories'])
        ->whereNull('deletedBy')->get();
        $assets = Asset::all();
        $categories = Category::all();
        $danliris_datefilter = Danliris_Movement::whereBetween('createdUtc', array($request->from_date, $request->to_date));
        $danliris_assetfilter = Danliris_Movement::where('asset_name', array($request->asset_name));
        if(!empty($request->ajax('from_date'))){
            if($request->ajax()){
                return DataTables::of($danliris_datefilter)
                ->addIndexColumn()
                ->make(true);
            }
        }
        else
        {
            if($request->ajax()){
                return DataTables::of($danliris_movements)
                ->addIndexColumn()
                ->make(true);
            }
        }
        return view('stock.danliris_stock.index', compact('assets', 'categories', 'danliris_movements', 'danliris_datefilter', 'danliris_assetfilter'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getDateFrom = Carbon::parse($request->input('createdUtc'))->format('Y-m-d');
        $getDateTo = Carbon::parse($request->input('createdUtcEnd'))->format('Y-m-d');
        $getFrom = $getDateFrom;
        $getTo = $getDateTo;
        $getAsset = $request->asset_name;
        $getStatus = $request->status;
        $getCategory = $request->category_name;
        $danliris_movements = Danliris_Movement::where('asset_name', $getAsset)->get();
        
        if($danliris_movements)
        {
            return response()->json(['status' => 200 , 'danliris_movements' => $danliris_movements, 'getAsset' => $getAsset, 'getFrom' => $getFrom, 'getTo' => $getTo, 'getStatus' => $getStatus, 'getCategory' => $getCategory]);
        }
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
