<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceMasukAsset;
use App\Models\Category;
use App\Models\AntrianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ServiceMasukAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service_masuk_assets = ServiceMasukAsset::with(['antrian_services', 'categories'])->whereNull('deletedBy')->get();
        $antrian_services = AntrianService::all();
        $categories = Category::all();
        if($request->ajax()){
            return DataTables::of($service_masuk_assets)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editServiceMasukAsset"><i class="far fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('service.servicemasukasset.index', compact('antrian_services', 'categories'));
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
            'nama_barang',
            'barcode',
            'no_seri'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $data = new ServiceMasukAsset();
            $data -> antrianservice_id = $request->input('antrianservice_id');
            $data -> category_id = $request->input('category_id');
            $data -> nama_barang = $request->input('nama_barang');
            $data -> barcode = $request->input('barcode');
            $data -> no_seri = $request->input('no_seri');
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
        $service_masuk_assets = ServiceMasukAsset::with(['antrian_services', 'categories'])->where('id', $id)->first();;
        $antrian_services = AntrianService::with('service_masuk_assets')->where('id', $service_masuk_assets->antrianservice_id)->first();
        $categories = Category::with('antrian_services')->where('id', $service_masuk_assets->category_id)->first();
        if($service_masuk_assets)
        {
            return response()->json(['status' => 200, 'service_masuk_assets' => $service_masuk_assets, 'antrian_services' => $antrian_services, 'categories' => $categories]);
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
            'nama_barang',
            'barcode',
            'no_seri'
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $service_masuk_assets = ServiceMasukAsset::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            if($service_masuk_assets)
            {
                $service_masuk_assets -> antrianservice_id = $request->input('antrianservice_id');
                $service_masuk_assets -> category_id = $request->input('category_id');
                $service_masuk_assets -> nama_barang = $request->input('nama_barang');
                $service_masuk_assets -> barcode = $request->input('barcode');
                $service_masuk_assets -> no_seri = $request->input('no_seri');
                $service_masuk_assets->updatedBy=$getBy;
                $service_masuk_assets->updatedUtc=$getUtc;
                $service_masuk_assets->update();
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
        $service_masuk_assets = ServiceMasukAsset::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        if($service_masuk_assets)
        {
            $service_masuk_assets->deletedBy = $getBy;
            $service_masuk_assets->deletedUtc = $getUtc;
            $service_masuk_assets->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $service_masuk_assets->errors()]);
        }
    }
}
