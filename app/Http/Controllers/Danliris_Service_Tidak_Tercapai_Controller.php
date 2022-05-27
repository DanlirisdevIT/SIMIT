<?php

namespace App\Http\Controllers;

use App\Models\Danliris_Antrianservice;
use App\Models\Division;
use App\Models\Unit;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use App\Models\Danliris_History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Danliris_Service_Tidak_Tercapai_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->input('date');
        // $dateFin = $request->input('tgl_selesai');

        $danliris_antrianservices = Danliris_Antrianservice::with([ 'danliris_histories', 'divisions', 'assets', 'units'])
        ->when($date, function ($query, $date){
            $query->where('danliris_antrianservice_id', $date);
        })
        // ->whereNull(['nama_teknisi', 'jenis_kerusakan', 'penyebab_kerusakan', 'tindakan_perbaikan'])
        ->whereNotNull('undone')->get();
        $danliris_histories = Danliris_History::whereNull('deletedBy')->get();
        $divisions = Division::whereNull('deletedBy')->get();
        $assets = Asset::whereNull('deletedBy')->get();
        $units = Unit::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($danliris_antrianservices)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data)
            {   
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm detail">Detail </a>';
                $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-success btn-sm editAntrianService"> Done </a>';
                return $btn;
                
            })
            ->rawColumns(['date', 'action'])
            ->make(true);
        }
        return view('service.undone_service.danliris_undoneservice.index', compact('danliris_histories' ,'divisions', 'assets', 'units'));
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
        $danliris_antrianservices = Danliris_Antrianservice::with([ 'danliris_histories'])->where('id', $id)->first();
        $danliris_histories = Danliris_History::with('danliris_antrianservices')->where('id', $danliris_antrianservices->danliris_history_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $danliris_antrianservices->date)->format('d-m-Y');
        // $getDateFin = Carbon::createFromFormat('Y-m-d', $danliris_antrianservices->tgl_selesai)->format('d-m-Y');
        if($danliris_antrianservices)
        {
            return response()->json(['status' => 200, 'danliris_antrianservices' => $danliris_antrianservices, 'danliris_histories' => $danliris_histories, 'getDate' => $getDate]);
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
            'nama_teknisi' => 'sometimes|required',
            'jenis_kerusakan' => 'sometimes|required',
            'tindakan_perbaikan' => 'sometimes|required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $danliris_antrianservices = Danliris_Antrianservice::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('final_date'))->format('Y-m-d');
            // $getDateFin = Carbon::parse($request->input('tgl_selesai'))->format('Y-m-d');
            if($danliris_antrianservices)
            {
                $danliris_antrianservices -> final_date_left = $getDate;
                // $danliris_antrianservices ->tgl_selesai = $getDateFin;
                $danliris_antrianservices -> nama_teknisi = $request->input('nama_teknisi');
                $danliris_antrianservices -> jenis_kerusakan = $request->input('jenis_kerusakan');
                $danliris_antrianservices -> tindakan_perbaikan = $request->input('tindakan_perbaikan');
                $danliris_antrianservices -> updatedBy=$getBy;
                $danliris_antrianservices -> updatedUtc=$getUtc;
                $danliris_antrianservices ->save();

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
        //
    }
}
