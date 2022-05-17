<?php

namespace App\Http\Controllers;

use App\Models\Efrata_Analysis;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use App\Models\Efrata_Antrianservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Efrata_Analysis_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_analyses = Efrata_Analysis::with([ 'efrata_antrianservices', 'categories', 'assets', 'units'])->whereNull('deletedBy')->get();
        $efrata_antrianservices = Efrata_Antrianservice::all();
        $categories = Category::all();
        $assets = Asset::all();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($efrata_analyses)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editAnalysis"><i class="far fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('service.analysis.efrata_analysis.index', compact('efrata_antrianservices' ,'categories', 'assets', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getAnalysis = $request->efrata_antrianservice_id;
        $efrata_antrianservices = Efrata_Antrianservice::with([ 'assets', 'units'])->where('id', $getAnalysis)->first();
        $assets = Asset::with('efrata_antrianser$efrata_antrianservices')->where('id', $efrata_antrianservices->asset_id)->first();
        $units = Unit::with('efrata_antrianser$efrata_antrianservices')->where('id', $efrata_antrianservices->unit_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getAnalysis' => $getAnalysis,'efrata_antrianservices' => $efrata_antrianservices,  'assets' => $assets, 'units' => $units ]);
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
            'efrata_antrianservice_id' => 'unique:Efrata_Analyses',
            'jenis_kerusakan' => 'required',
            'penyebab_kerusakan' => 'required',
            'tindakan_perbaikan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $data = new Efrata_Analysis();
            $data -> efrata_antrianservice_id = $request->efrata_antrianservice_id;
            $data -> asset_id = $request->input('asset_id');
            $data -> unit_id = $request->input('unit_id');
            $data -> category_id = $request->input('category_id');
            $data -> jenis_kerusakan = $request->input('jenis_kerusakan');
            $data -> penyebab_kerusakan = $request->input('penyebab_kerusakan');
            $data -> tindakan_perbaikan = $request->input('tindakan_perbaikan');
            $data -> createdBy = $getBy;
            $data -> createdUtc = $getUtc;
            $data -> save();

            return response()->json(['status' => 200, 'messages' => 'Data telah ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        // $efrata_analyses = Efrata_Analysis::with([ 'efrata_servicefinals' ,'categories', 'assets', 'units'])->where('id', $id)->first();;
        // $efrata_servicefinals = Efrata_Servicefinal::with('efrata_analyses')->where('id', $efrata_analyses->efrata_servicefinal_id)->first();
        // $categories = Category::with('efrata_analyses')->where('id', $efrata_analyses->category_id)->first();
        // $assets = Asset::with('efrata_analyses')->where('id', $efrata_analyses->asset_id)->first();
        // $units = Unit::with('efrata_analyses')->where('id', $efrata_analyses->unit_id)->first();
        // if($efrata_analyses)
        // {
        //     return response()->json(['status' => 200, 'efrata_analyses' => $efrata_analyses, 'efrata_servicefinals' => $efrata_servicefinals, 'categories' => $categories, 'assets' => $assets, 'units' => $units]);
        // }
        // else
        // {
        //     return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
        // }
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
        //     'jenis_kerusakan' => 'required',
        //     'penyebab_kerusakan' => 'required',
        //     'tindakan_perbaikan' => 'required',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        // }
        // else
        // {
        //     $efrata_analyses = Efrata_Analysis::find($id);
        //     $getBy = Auth::user()->name;
        //     $getUtc = Carbon::now();
        //     if($efrata_analyses)
        //     {
                
        //         $efrata_analyses -> efrata_servicefinal_id = $request->efrata_servicefinal_id;
        //         $efrata_analyses -> asset_id = $request->input('asset_id');
        //         $efrata_analyses -> unit_id = $request->input('unit_id');
        //         $efrata_analyses -> category_id = $request->input('category_id');
        //         $efrata_analyses -> jenis_kerusakan = $request->input('jenis_kerusakan');
        //         $efrata_analyses -> penyebab_kerusakan = $request->input('penyebab_kerusakan');
        //         $efrata_analyses -> tindakan_perbaikan = $request->input('tindakan_perbaikan');
        //         $efrata_analyses -> updatedBy=$getBy;
        //         $efrata_analyses -> updatedUtc=$getUtc;
        //         $efrata_analyses ->update();
        //         return response()->json(['status' => 200, 'messages' => 'Data berhasil diperbaharui.']);
        //     }
        //     else
        //     {
        //         return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $efrata_analyses = Efrata_Analysis::find($id);
        // $getBy = Auth::user()->name;
        // $getUtc = Carbon::now();
        // if($efrata_analyses)
        // {
        //     $efrata_analyses->deletedBy = $getBy;
        //     $efrata_analyses->deletedUtc = $getUtc;
        //     $efrata_analyses->update();

        //     return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        // }
        // else
        // {
        //     return response()->json(['status' => 400, 'messages' => $efrata_analyses->errors()]);
        // }
    }
}
