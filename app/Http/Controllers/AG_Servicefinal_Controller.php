<?php

namespace App\Http\Controllers;

use App\Models\AG_Servicefinal;
use App\Models\AG_Antrianservice;
use App\Models\Division;
use App\Models\Unit;
use App\Models\Asset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AG_Servicefinal_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ag_servicefinals = AG_Servicefinal::with([ 'ag_antrianservices', 'divisions', 'assets', 'units'])->whereNull('deletedBy')->get();
        $ag_antrianservices = AG_Antrianservice::all();
        $divisions = Division::all();
        $assets = Asset::all();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($ag_servicefinals)
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

        return view('service.historyservice.ag_historyservice.index', compact('ag_antrianservices' ,'divisions', 'assets', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getServiceFinal = $request->ag_antrianservice_id;
        $ag_antrianservices = AG_Antrianservice::with([ 'assets', 'divisions', 'units'])->where('id', $getServiceFinal)->first();
        $assets = Asset::with('ag_antrianservices')->where('id', $ag_antrianservices->asset_id)->first();
        $divisions = Division::with('ag_antrianservices')->where('id', $ag_antrianservices->division_id)->first();
        $units = Unit::with('ag_antrianservices')->where('id', $ag_antrianservices->unit_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getServiceFinal' => $getServiceFinal,'ag_antrianservices' => $ag_antrianservices,  'divisions'=>$divisions, 'assets' => $assets, 'units' => $units ]);
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
            'ag_antrianservice_id' => 'unique:AG_Servicefinals',
            'nama_teknisi' => 'required'
        ],
        [
            'ag_antrianservice_id.unique' => 'kode sudah terpakai!'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            $data = new AG_Servicefinal();
            $data -> date = $getDate;
            $data -> ag_antrianservice_id = $request->ag_antrianservice_id;
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
        // $ag_servicefinals = AG_Servicefinal::with([ 'ag_antrianservices','divisions', 'assets', 'units'])->where('id', $id)->first();;
        // $ag_antrianservices = AG_Antrianservice::with('ag_servicefinals')->where('id', $ag_servicefinals->ag_antrianservice_id)->first();
        // $divisions = Division::with('ag_servicefinals')->where('id', $ag_servicefinals->division_id)->first();
        // $assets = Asset::with('ag_servicefinals')->where('id', $ag_servicefinals->asset_id)->first();
        // $units = Unit::with('ag_servicefinals')->where('id', $ag_servicefinals->unit_id)->first();
        // $getDate = Carbon::createFromFormat('Y-m-d', $ag_servicefinals->date)->format('d-m-Y');
        // if($ag_servicefinals)
        // {
        //     return response()->json(['status' => 200, 'ag_servicefinals' => $ag_servicefinals, 'ag_antrianservices' => $ag_antrianservices, 'divisions' => $divisions, 'assets' => $assets, 'units' => $units, 'getDate' => $getDate]);
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
        //     $ag_servicefinals = AG_Servicefinal::find($id);
        //     $getBy = Auth::user()->name;
        //     $getUtc = Carbon::now();
        //     $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
        //     if($ag_servicefinals)
        //     {
        //         $ag_servicefinals -> date = $getDate;
        //         $ag_servicefinals -> ag_antrianservice_id = $request->ag_antrianservice_id;
        //         $ag_servicefinals -> username = $request->input('username');
        //         $ag_servicefinals -> division_id = $request->input('division_id');
        //         $ag_servicefinals -> asset_id = $request->input('asset_id');
        //         $ag_servicefinals -> unit_id = $request->input('unit_id');
        //         $ag_servicefinals -> asset_ip = $request->input('asset_ip');
        //         $ag_servicefinals -> status = $request->input('status');
        //         $ag_servicefinals -> nama_teknisi = $request->input('nama_teknisi');
        //         $ag_servicefinals -> updatedBy=$getBy;
        //         $ag_servicefinals -> updatedUtc=$getUtc;
        //         $ag_servicefinals ->update();
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
        // $ag_servicefinals = AG_Servicefinal::find($id);
        // $getBy = Auth::user()->name;
        // $getUtc = Carbon::now();
        // if($ag_servicefinals)
        // {
        //     $ag_servicefinals->deletedBy = $getBy;
        //     $ag_servicefinals->deletedUtc = $getUtc;
        //     $ag_servicefinals->update();

        //     return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        // }
        // else
        // {
        //     return response()->json(['status' => 400, 'messages' => $ag_servicefinals->errors()]);
        // }
    }
}
