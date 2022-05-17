<?php

namespace App\Http\Controllers;

use App\Models\Efrata_Antrianservice;
use App\Models\Division;
use App\Models\Unit;
use App\Models\Asset;
use App\Models\Efrata_History;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Efrata_Antrianservice_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_antrianservices = Efrata_Antrianservice::with(['efrata_histories', 'divisions', 'assets', 'units'])->whereNull('deletedBy')->get();
        $efrata_histories = Efrata_History::all();
        $divisions = Division::all();
        $assets = Asset::all();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($efrata_antrianservices)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editAntrianService"> Done </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('service.antrianservice.efrata_antrianservice.index', compact('efrata_histories' ,'divisions', 'assets', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getAntrianservice = $request->efrata_history_id;
        $efrata_histories = Efrata_History::with([ 'assets', 'divisions', 'units'])->where('id', $getAntrianservice)->first();
        $assets = Asset::with('efrata_histories')->where('id', $efrata_histories->asset_id)->first();
        $divisions = Division::with('efrata_histories')->where('id', $efrata_histories->division_id)->first();
        $units = Unit::with('danliris_histories')->where('id', $efrata_histories->unit_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getAntrianservice' => $getAntrianservice,'efrata_histories' => $efrata_histories,  'divisions'=>$divisions, 'assets' => $assets, 'units' => $units ]);
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
            'date' => 'required',
            'status' => 'required',
            'prioritas' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            $data = new Efrata_Antrianservice();
            $data -> date = $getDate;
            $data -> efrata_history_id = $request->efrata_history_id;
            $data -> username = $request->input('username');
            $data -> division_id = $request->input('division_id');
            $data -> unit_id = $request->input('unit_id');
            $data -> asset_id = $request->input('asset_id');
            $data -> asset_ip = $request->input('asset_ip');
            $data -> status = $request->input('status');
            $data -> prioritas = $request->input('prioritas');
            $data -> time_remaining = $request->input('time_remaining');
            $data -> barcode = $request->input('barcode');
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
        $efrata_antrianservices = Efrata_Antrianservice::with(['efrata_histories' ,'divisions', 'assets', 'units'])->where('id', $id)->first();;
        $efrata_histories = Efrata_History::with('efrata_antrianservices')->where('id', $efrata_antrianservices->efrata_history_id)->first();
        $divisions = Division::with('efrata_antrianservices')->where('id', $efrata_antrianservices->division_id)->first();
        $assets = Asset::with('efrata_antrianservices')->where('id', $efrata_antrianservices->asset_id)->first();
        $units = Unit::with('efrata_antrianservices')->where('id', $efrata_antrianservices->unit_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $efrata_antrianservices->date)->format('d-m-Y');
        if($efrata_antrianservices)
        {
            return response()->json(['status' => 200, 'efrata_antrianservices' => $efrata_antrianservices, 'efrata_histories' => $efrata_histories, 'divisions' => $divisions, 'assets' => $assets, 'units' => $units, 'getDate' => $getDate]);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
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
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'prioritas' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $efrata_antrianservices = Efrata_Antrianservice::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            if($efrata_antrianservices)
            {
                $efrata_antrianservices -> date = $getDate;
                $efrata_antrianservices -> nama_teknisi = $request->input('nama_teknisi');
                $efrata_antrianservices -> jenis_kerusakan = $request->input('jenis_kerusakan');
                $efrata_antrianservices -> tindakan_perbaikan = $request->input('tindakan_perbaikan');
                $efrata_antrianservices->updatedBy=$getBy;
                $efrata_antrianservices->updatedUtc=$getUtc;
                $efrata_antrianservices->update();
                return response()->json(['status' => 200, 'messages' => 'Data berhasil diperbaharui.']);
            }
            else
            {
                return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $efrata_antrianservices = Efrata_Antrianservice::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        if($efrata_antrianservices)
        {
            $efrata_antrianservices->deletedBy = $getBy;
            $efrata_antrianservices->deletedUtc = $getUtc;
            $efrata_antrianservices->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $efrata_antrianservices->errors()]);
        }
    }
}
