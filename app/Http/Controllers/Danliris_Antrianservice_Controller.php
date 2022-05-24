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

class Danliris_Antrianservice_Controller extends Controller
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
        ->whereNull('deletedBy')->whereNull('tgl_selesai')->whereNull('nama_teknisi')->whereNull('jenis_kerusakan')->whereNull('tindakan_perbaikan')->get();
        $danliris_histories = Danliris_History::all();
        $divisions = Division::all();
        $assets = Asset::all();
        $units = Unit::all();
        // $deliveryDateToSec = strtotime($date);
        // $currentDateToSec = strtotime(Date('Y-m-d'));
        // $dateDiff = $deliveryDateToSec - $currentDateToSec;
        // $daysLeft = $dateDiff/86400;
        // $daysLeft = intVal($daysLeft);
        if($request->ajax()){
            return DataTables::of($danliris_antrianservices)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            // ->addColumn('tgl_selesai', function($data) {
            //     $dateFin = Carbon::createFromFormat('Y-m-d', $data->tgl_selesai)->format('d F Y');
            // })
            // ->addColumn('tgl_selesai', function($data) {
            //     $tgl_selesai = Carbon::createFromFormat('Y-m-d', $data->tgl_selesai)->format('d F Y');
            //     return $tgl_selesai;
            // })
            ->addColumn('time_remaining', function($data) {
                if($data->time_remaining == "3")
                {
                    return "3 Hari";
                }
                else if($data->time_remaining == "60")
                {
                    return "3 Bulan";
                }
            })
            ->addColumn('sisa_hari', function($data) {
                $data_date = $data->date;
                $deliveryDateToSec = strtotime($data_date);
                $currentDateToSec = strtotime(Date('Y-m-d'));
                $dateDiff = $currentDateToSec - $deliveryDateToSec;

                if($data->time_remaining == "3")
                {
                    $daysLeft = $dateDiff/86400;
                    $daysLeft = intVal($daysLeft);
                    return $daysLeft;
                }
                else if($data->time_remaining == "60")
                {
                    $daysLeft = $dateDiff/5184000;
                    $daysLeft = intVal($daysLeft);
                    return $daysLeft;
                }

            })
            ->addColumn('action', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editAntrianService1">Edit </a>';
                $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-success btn-sm editAntrianService">Done </a>';
                
                // $btn = $btn.'<a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" data-original-title="selesai" class="btn btn-success btn-sm selesaiAntrianService"><i class="fas fa-flag-checkered"></i></a>';
                return $btn;
            })
            ->rawColumns(['date', 'action', 'sisa_hari'])
            ->make(true);
        }

        return view('service.antrianservice.danliris_antrianservice.index', compact('danliris_histories' ,'divisions', 'assets', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getAntrianservice = $request->danliris_history_id;
        $danliris_histories = Danliris_History::with([ 'assets', 'divisions', 'units'])->where('id', $getAntrianservice)->first();
        $assets = Asset::with('danliris_histories')->where('id', $danliris_histories->asset_id)->first();
        $divisions = Division::with('danliris_histories')->where('id', $danliris_histories->division_id)->first();
        $units = Unit::with('danliris_histories')->where('id', $danliris_histories->unit_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getAntrianservice' => $getAntrianservice,'danliris_histories' => $danliris_histories,  'divisions'=>$divisions, 'assets' => $assets, 'units' => $units ]);
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
            // 'danliris_history_id' => 'unique:Danliris_Antrianservices',
            'status' => 'required',
            'prioritas' => 'required',
        ],
        [
            // 'danliris_history_id.unique' => 'masih dalam perbaikan!'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            $data = new Danliris_Antrianservice();
            $data -> date = $getDate;
            $data -> danliris_history_id = $request->danliris_history_id;
            $data -> username = $request->input('username');
            $data -> divisi_name = $request->divisi_name;
            $data -> unit_name = $request->unit_name;
            $data -> asset_name = $request->asset_name;
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

    //Button Edit
    public function edit1($id)
    {
        $danliris_antrianservices = Danliris_Antrianservice::with([ 'danliris_histories'])->where('id', $id)->first();
        $danliris_histories = Danliris_History::with('danliris_antrianservices')->where('id', $danliris_antrianservices->danliris_history_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $danliris_antrianservices->date)->format('d-m-Y');
        if($danliris_antrianservices)
        {
            return response()->json(['status' => 200, 'danliris_antrianservices' => $danliris_antrianservices, 'danliris_histories' => $danliris_histories, 'getDate' => $getDate]);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
        }
    }

    public function update1(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_teknisi' => 'nullable',
            'jenis_kerusakan' => 'nullable',
            'penyebab_kerusakan' => 'nullable',
            'tindakan_perbaikan' => 'nullable'
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
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            if($danliris_antrianservices)
            {
                $danliris_antrianservices -> date = $getDate;
                $danliris_antrianservices -> danliris_history_id = $request->danliris_history_id;
                $danliris_antrianservices -> status = $request->input('status');
                $danliris_antrianservices -> prioritas = $request->input('prioritas');
                $danliris_antrianservices -> updatedBy=$getBy;
                $danliris_antrianservices -> updatedUtc=$getUtc;
                $danliris_antrianservices ->update();

                return response()->json(['status' => 200, 'messages' => 'Data berhasil diperbaharui.']);
            }
            else
            {
                return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //button done
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
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            // $getDateFin = Carbon::parse($request->input('tgl_selesai'))->format('Y-m-d');
            if($danliris_antrianservices)
            {
                $danliris_antrianservices -> date = $getDate;
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
        $danliris_antrianservices = Danliris_Antrianservice::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        if($danliris_antrianservices)
        {
            $danliris_antrianservices->deletedBy = $getBy;
            $danliris_antrianservices->deletedUtc = $getUtc;
            $danliris_antrianservices->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $danliris_antrianservices->errors()]);
        }
    }

   
}
