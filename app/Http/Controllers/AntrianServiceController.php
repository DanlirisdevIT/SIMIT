<?php

namespace App\Http\Controllers;

use App\Models\AntrianService;
use App\Models\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AntrianServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $antrian_services = AntrianService::with(['units'])->whereNull('deletedBy')->get();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($antrian_services)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editAntrianService"><i class="far fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('service.antrianservice.index', compact('units'));
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
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'name' => 'required',
            'nama_barang' => 'required',
            'barcode' => 'required',
            'no_seri' => 'required',
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

            $data = new AntrianService();
            $data -> date = $getDate;
            $data -> name = $request->input('name');
            $data -> unit_id = $request->input('unit_id');
            $data -> nama_barang = $request->input('nama_barang');
            $data -> barcode = $request->input('barcode');
            $data -> no_seri = $request->input('no_seri');
            $data -> status = $request->input('status');
            $data -> prioritas = $request->input('prioritas');
            $data -> createdBy = $getBy;
            $data -> createdUtc = $getUtc;
            $data -> save();

            return response()->json(['status' => 200, 'messages' => 'Data telah ditambahkan']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AntrianService  $antrianService
     * @return \Illuminate\Http\Response
     */
    public function show(AntrianService $antrianService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AntrianService  $antrianService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $antrian_services = AntrianService::with(['units'])->where('id', $id)->first();;
        $units = Unit::with('antrian_services')->where('id', $antrian_services->unit_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $antrian_services->date)->format('d-m-Y');
        if($antrian_services)
        {
            return response()->json(['status' => 200, 'antrian_services' => $antrian_services, 'units' => $units, 'getDate' => $getDate]);
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
     * @param  \App\Models\AntrianService  $antrianService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nama_barang' => 'required',
            'barcode' => 'required',
            'no_seri' => 'required',
            'status' => 'required',
            'prioritas' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $antrian_services = AntrianService::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            if($antrian_services)
            {
                $antrian_services -> date = $getDate;
                $antrian_services -> name = $request->input('name');
                $antrian_services -> unit_id = $request->input('unit_id');
                $antrian_services -> nama_barang = $request->input('nama_barang');
                $antrian_services -> barcode = $request->input('barcode');
                $antrian_services -> no_seri = $request->input('no_seri');
                $antrian_services -> status = $request->input('status');
                $antrian_services -> prioritas = $request->input('prioritas');
                $antrian_services->updatedBy=$getBy;
                $antrian_services->updatedUtc=$getUtc;
                $antrian_services->update();
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
     * @param  \App\Models\AntrianService  $antrianService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $antrian_services = AntrianService::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        if($antrian_services)
        {
            $antrian_services->deletedBy = $getBy;
            $antrian_services->deletedUtc = $getUtc;
            $antrian_services->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $antrian_services->errors()]);
        }
    }
}
