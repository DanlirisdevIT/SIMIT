<?php

namespace App\Http\Controllers;

use App\Models\Danliris_Servicefinal;
use App\Models\Danliris_Antrianservice;
use App\Models\Unit;
use App\Models\Asset;
use App\Models\Division;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Danliris_Analysis_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $danliris_analyses = Danliris_Analysis::with([ 'danliris_servicefinals', 'assets', 'units'])->whereNull('deletedBy')->get();
        // $danliris_servicefinals = Danliris_Servicefinal::all();
        // $assets = Asset::all();
        // $units = Unit::all();
        // if($request->ajax()){
        //     return DataTables::of($danliris_analyses)
        //     ->addIndexColumn()
        //     // ->addColumn('date', function($data) {
        //     //     $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
        //     //     return $date;
        //     // })
        //     // ->addColumn('action', function($data){
        //     //     $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editAnalysis"><i class="far fa-edit"></i></a>';
        //     //     return $btn;
        //     // })
        //     ->rawColumns(['action'])
        //     ->make(true);
        // }

        // return view('service.analysis.danliris_analysis.index', compact('danliris_servicefinals' , 'assets', 'units'));

        $danliris_antrianservices = Danliris_Antrianservice::with(['danliris_servicefinals' ,'divisions', 'units', 'assets'])->whereNull('deletedBy')->get();
        $danliris_servicefinals = Danliris_Servicefinal::all();
        $divisions = Division::all();
        $units = Unit::all();
        $assets = Asset::all();
        if($request->ajax()){
            return DataTables::of($danliris_antrianservices)
            ->addIndexColumn()
            ->make(true);
        }

        return view('service.analysis.danliris_analysis.index', compact('danliris_servicefinals' ,'divisions', 'units', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
