<?php

namespace App\Http\Controllers;

use App\Models\Efrata_Servicefinal;
use App\Models\Efrata_Antrianservice;
use App\Models\Division;
use App\Models\Unit;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Efrata_Servicefinal_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_servicefinals = Efrata_Servicefinal::with([ 'efrata_antrianservices', 'divisions', 'assets', 'units'])->whereNull('deletedBy')->get();
        $efrata_antrianservices = Efrata_Antrianservice::all();
        $divisions = Division::all();
        $assets = Asset::all();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($efrata_servicefinals)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data){
                // $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editServiceFinal"><i class="far fa-edit"></i></a>';
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-danger btn-sm editServiceFinal"><i class="fas fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('service.historyservice.danliris_historyservice.index', compact('efrata_antrianservices' ,'divisions', 'assets', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getServiceFinal = $request->efrata_antrianservice_id;
        $efrata_antrianservices = Efrata_Antrianservice::with([ 'assets', 'divisions', 'units'])->where('id', $getServiceFinal)->first();
        $assets = Asset::with('efrata_antrianservices')->where('id', $efrata_antrianservices->asset_id)->first();
        $divisions = Division::with('efrata_antrianservices')->where('id', $efrata_antrianservices->division_id)->first();
        $units = Unit::with('efrata_antrianservices')->where('id', $efrata_antrianservices->unit_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getServiceFinal' => $getServiceFinal,'efrata_antrianservices' => $efrata_antrianservices,  'divisions'=>$divisions, 'assets' => $assets, 'units' => $units ]);
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
            'efrata_antrianservice_id' => 'unique:Efrata_Servicefinals',
            'nama_teknisi' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            $data = new Efrata_Servicefinal();
            $data -> date = $getDate;
            $data -> efrata_antrianservice_id = $request->efrata_antrianservice_id;
            $data -> username = $request->input('username');
            $data -> division_id = $request->input('division_id');
            $data -> asset_id = $request->input('asset_id');
            $data -> unit_id = $request->input('unit_id');
            $data -> asset_ip = $request->input('asset_ip');
            $data -> status = $request->input('status');
            $data -> nama_teknisi = $request->input('nama_teknisi');
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
        // $efrata_servicefinals = Efrata_Servicefinal::with([ 'efrata_antrianservices','divisions', 'assets', 'units'])->where('id', $id)->first();;
        // $efrata_antrianservices = Efrata_Antrianservice::with('efrata_servicefinals')->where('id', $efrata_servicefinals->efrata_antrianservice_id)->first();
        // $divisions = Division::with('efrata_servicefinals')->where('id', $efrata_servicefinals->division_id)->first();
        // $assets = Asset::with('efrata_servicefinals')->where('id', $efrata_servicefinals->asset_id)->first();
        // $units = Unit::with('efrata_servicefinals')->where('id', $efrata_servicefinals->unit_id)->first();
        // $getDate = Carbon::createFromFormat('Y-m-d', $efrata_servicefinals->date)->format('d-m-Y');
        // if($efrata_servicefinals)
        // {
        //     return response()->json(['status' => 200, 'efrata_servicefinals' => $efrata_servicefinals, 'efrata_antrianservices' => $efrata_antrianservices, 'divisions' => $divisions, 'assets' => $assets, 'units' => $units, 'getDate' => $getDate]);
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
        //     'nama_teknisi' => 'required',
        // ]);

        // if($validator->fails())
        // {
        //     return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        // }
        // else
        // {
        //     $efrata_servicefinals = Efrata_Servicefinal::find($id);
        //     $getBy = Auth::user()->name;
        //     $getUtc = Carbon::now();
        //     $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
        //     if($efrata_servicefinals)
        //     {
        //         $efrata_servicefinals -> date = $getDate;
        //         $efrata_servicefinals -> efrata_antrianservice_id = $request->efrata_antrianservice_id;
        //         $efrata_servicefinals -> username = $request->input('username');
        //         $efrata_servicefinals -> division_id = $request->input('division_id');
        //         $efrata_servicefinals -> asset_id = $request->input('asset_id');
        //         $efrata_servicefinals -> unit_id = $request->input('unit_id');
        //         $efrata_servicefinals -> asset_ip = $request->input('asset_ip');
        //         $efrata_servicefinals -> status = $request->input('status');
        //         $efrata_servicefinals -> nama_teknisi = $request->input('nama_teknisi');
        //         $efrata_servicefinals -> updatedBy=$getBy;
        //         $efrata_servicefinals -> updatedUtc=$getUtc;
        //         $efrata_servicefinals ->update();
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
        // $efrata_servicefinals = Efrata_Servicefinal::find($id);
        // $getBy = Auth::user()->name;
        // $getUtc = Carbon::now();
        // if($efrata_servicefinals)
        // {
        //     $efrata_servicefinals->deletedBy = $getBy;
        //     $efrata_servicefinals->deletedUtc = $getUtc;
        //     $efrata_servicefinals->update();

        //     return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        // }
        // else
        // {
        //     return response()->json(['status' => 400, 'messages' => $efrata_servicefinals->errors()]);
        // }
    }
}
