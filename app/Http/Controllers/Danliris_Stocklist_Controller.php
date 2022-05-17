<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\Danliris_StocklistImport;
use App\Exports\Danliris_StocklistExport;
use App\Models\Danliris_RBT;
use App\Models\Danliris_Stocklist;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class Danliris_Stocklist_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $danliris_stocklists = Danliris_Stocklist::get();
        $danliris_datefilter = Danliris_Stocklist::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        if(!empty($request->ajax('from_date'))){
            if($request->ajax()){
                return Datatables::of($danliris_datefilter)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editStockOpname">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        }
        else{
            if($request->ajax()){
                return Datatables::of($danliris_stocklists)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editStockOpname">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            
        }
        return view('stock.danliris_stockopname.index', ['danliris_stocklists' => $danliris_stocklists, 'danliris_datefilter' => $danliris_datefilter]);

        // $danliris_stocklists = Danliris_Stocklist::get();
        // $danliris_datefilter = Danliris_Stocklist::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        // if(!empty($request->from_date())){
        //     return DataTables::of($danliris_datefilter)
        //     ->addIndexColumn()
        //     ->make(true);
        // }
        // else($request->ajax()){
        //     return DataTables::of($danliris_stocklists)
        //     ->addIndexColumn()
        //     ->addColumn('action', function($data) {
        //                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editStockOpname">Edit</a>';
        //                 return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        // return view('stock.danliris_stockopname.index', ['danliris_stocklists' => $danliris_stocklists, 'danliris_datefilter' => $danliris_datefilter]);
    }

    public function import(Request $request)
    {

        Excel::import(new Danliris_StocklistImport, $request->file('file'));
        return back();
    }

    public function export (Request $request)
    {
        return Excel::download(new Danliris_StocklistExport, 'Template.xlsx');
    }

    // public function records(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         if($request->start_date != '' && $request->end_date != '')
    //         {
    //             $data = Danliris_Stocklist::whereBetween('created_at', array($request->start_date, $request->end_date))->get();
    //         }
    //         else
    //         {
    //             $data = Danliris_Stocklist::orderBy('created_at', 'desc')->get();
    //         }
    //     }
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'date' => 'required',
            // 'quantity' => 'required',
            // 'unitPrice' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->level;
            $createdUtc = Carbon::now();
            // $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            // $budget_uniqueid = Helper::IDGenerator(new Danliris_budget, 'budget_id', 'BUDGET', 5);

            $data = new Danliris_Stocklist();
            $data -> username = $request->input('username');
            $data -> nama_barang = $request->input('nama_barang');
            $data -> manufacture = $request->input('manufacture');
            $data -> merk = $request->input('merk');
            $data -> processor = $request->input('processor');
            $data -> power_supply = $request->input('power_supply');
            $data -> casing = $request->input('casing');
            $data -> hddslot1 = $request->input('hddslot1');
            $data -> hddslot2 = $request->input('hddslot2');
            $data -> ramslot1 = $request->input('ramslot1');
            $data -> ramslot2 = $request->input('ramslot2');
            $data -> fan_processor = $request->input('fan_processor');
            $data -> dvd_internal = $request->input('dvd_internal');
            $data -> asset_ip = $request->input('asset_ip');
            $data -> company = $request->input('company');
            $data -> divisi = $request->input('divisi');
            $data -> unit = $request->input('unit');
            $data -> location = $request->input('location');
            $data -> status = $request->input('status');
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

             return response()->json(['status'=>200, 'messages'=>'Data berhasil ditambahkan.']);
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danliris_stocklists = Danliris_Stocklist::where('id', $id)->first();
       
        if($danliris_stocklists)
        {
            return response()->json(['status' => 200, 'danliris$danliris_stocklists' => $danliris_stocklists]);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan']);
        }
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
        // $validator = Validator::make($request->all(), [
        //     // 'quantity' => 'required',
        //     // 'unitPrice' => 'required',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        // }
        // else
        // {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $danliris_stocklists = Danliris_Stocklist::find($id);

            if($danliris_stocklists)
            {
                $danliris_stocklists -> username = $request->input('username');
                $danliris_stocklists -> nama_barang = $request->input('nama_barang');
                $danliris_stocklists -> manufacture = $request->input('manufacture');
                $danliris_stocklists -> merk = $request->input('merk');
                $danliris_stocklists -> processor = $request->input('processor');
                $danliris_stocklists -> power_supply = $request->input('power_supply');
                $danliris_stocklists -> casing = $request->input('casing');
                $danliris_stocklists -> hddslot1 = $request->input('hddslot1');
                $danliris_stocklists -> hddslot2 = $request->input('hddslot2');
                $danliris_stocklists -> ramslot1 = $request->input('ramslot1');
                $danliris_stocklists -> ramslot2 = $request->input('ramslot2');
                $danliris_stocklists -> fan_processor = $request->input('fan_processor');
                $danliris_stocklists -> dvd_internal = $request->input('dvd_internal');
                $danliris_stocklists -> asset_ip = $request->input('asset_ip');
                $danliris_stocklists -> company = $request->input('company');
                $danliris_stocklists -> divisi = $request->input('divisi');
                $danliris_stocklists -> unit = $request->input('unit');
                $danliris_stocklists -> location = $request->input('location');
                $danliris_stocklists -> status = $request->input('status');
                $danliris_stocklists -> updatedBy = $getBy;
                $danliris_stocklists -> updatedUtc = $getUtc;
                $danliris_stocklists -> update();
                return response()->json(['status' => 200, 'messages' => 'Data berhasil diperbaharui.']);
            }
            else
            {
                return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
            }
        // }
    }
}
