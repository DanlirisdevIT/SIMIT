<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Company;
use App\Models\Efrata_Pemasukan;
use App\Models\Efrata_Pengeluaran;
use App\Models\Efrata_Permintaan;
use App\Models\Division;
use App\Models\Location;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Efrata_Pengeluaran_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_pengeluarans = Efrata_Pengeluaran::with(['efrata_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories'])->whereNull('deletedBy')->get();
        $assets = Asset::all();
        $companies = Company::all();
        $divisions = Division::all();
        $units = Unit::all();
        $users = User::all();
        $locations = Location::all();
        $categories = Category::all();
        $efrata_pemasukans = Efrata_Pemasukan::all();

        if($request->ajax()){
            return DataTables::of($efrata_pengeluarans)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editPengeluaran"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" asset_name="'.$data->asset_name.'" model_number="'.$data->model_number.'" EOL="'.$data->EOL.'"  data-original-title="Delete" class="btn btn-danger btn-sm deleteAsset"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pengeluaran.efrata_pengeluaran.index', compact('efrata_pengeluarans', 'efrata_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories'));
    }

    public function getPemasukan_ef()
    {
        $efrata_pemasukans_1 = Efrata_Pemasukan::whereNotIn('pemasukan_type', ['to it stock', 'replacement'])->whereNull('deletedBy')->get();
        $efrata_pemasukans_2 = Efrata_Pemasukan::whereNotIn('pemasukan_type', ['to user', 'replacement'])->whereNull('deletedBy')->get();
        $efrata_pemasukans_3 = Efrata_Pemasukan::whereNotIn('pemasukan_type', ['to user', 'to_it_stock'])->whereNull('deletedBy')->get();

        return response()->json(['status' => 200, 'efrata_pemasukans_1' => $efrata_pemasukans_1, 'efrata_pemasukans_2' => $efrata_pemasukans_2, 'efrata_pemasukans_3' => $efrata_pemasukans_3]);
    }

    public function getBarang_ef()
    {
        $getBarang = Asset::whereNull('deletedBy')->get();
        // $getBarang_category = Category::where('id', $getBarang->category_id)->get();

        return response()->json(['status' => 200, 'getBarang' => $getBarang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $efrata_pemasukanAll = Efrata_Pemasukan::all();
        $getPemasukan = $request->efrata_pemasukan_id;
        $efrata_pengeluaran = Efrata_Pengeluaran::with(['efrata_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories', 'efrata_permintaans'])->where('id', $getPemasukan)->first();
        $efrata_pemasukan = Efrata_Pemasukan::with('efrata_pengeluarans')->where('id', $getPemasukan)->first();
        $getUser = Efrata_Permintaan::find($efrata_pemasukan)->first();
        $getUnit = Unit::find($efrata_pemasukan)->first();
        $getDivisi = Division::find($efrata_pemasukan)->first();

        return response()->json(['status' => 200, 'getPemasukan' => $getPemasukan, 'efrata_pemasukan' => $efrata_pemasukan, 'efrata_pengeluaran' => $efrata_pengeluaran,
                                                'getUser' => $getUser, 'efrata_pemasukanAll' => $efrata_pemasukanAll, 'getUnit' => $getUnit, 'getDivisi' => $getDivisi]);
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
            'pengeluaran_type' => 'required',
            'asset_ip' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            $data = new Efrata_Pengeluaran();
            $data->date = $getDate;
            $data->pengeluaran_type = $request->pengeluaran_type;
            $data->efrata_pemasukan_id = $request->efrata_pemasukan_id;
            $data->category_name = $request->category_name;
            $data->category_type = $request->category_type;
            $data->barcode = $request->barcode;
            $data->asset_ip = $request->input('asset_ip');
            $data->quantity = $request->input('quantity');
            $data->description = $request->input('description');
            $data->unit_name = $request->unit_name;
            $data->username = $request->username;
            $data->division_name = $request->division_name;

            $data -> createdBy = $getBy;
            $data -> createdUtc = $getUtc;
            $data->save();

            return response()->json(['status'=>200, 'messages'=>'Data telah ditambahkan']);
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
        $efrata_pengeluarans = Efrata_Pengeluaran::with(['efrata_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories', 'efrata_permintaans'])->where('id', $id)->first();
        $efrata_pemasukans = Efrata_Pemasukan::with('efrata_pengeluarans')->where('id', $efrata_pengeluarans->efrata_pemasukan_id)->first();

        return response()->json(['status' => 200, 'efrata_pengeluarans' => $efrata_pengeluarans, 'efrata_pemasukans' => $efrata_pemasukans]);

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
            'date' => 'required',
            'pengeluaran_type' => 'required',
            'asset_ip' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $efrata_pengeluaran = Efrata_Pengeluaran::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->date)->format('Y-m-d');

            if($efrata_pengeluaran)
            {
                $efrata_pengeluaran->date = $getDate;
                $efrata_pengeluaran->pengeluaran_type = $request->pengeluaran_type;
                $efrata_pengeluaran->efrata_pemasukan_id = $request->efrata_pemasukan_id;
                $efrata_pengeluaran->category_name = $request->category_name;
                $efrata_pengeluaran->category_type = $request->category_type;
                $efrata_pengeluaran->barcode = $request->barcode;
                $efrata_pengeluaran->asset_ip = $request->input('asset_ip');
                $efrata_pengeluaran->quantity = $request->input('quantity');
                $efrata_pengeluaran->description = $request->input('description');
                $efrata_pengeluaran->username = $request->username;
                $efrata_pengeluaran->unit_name = $request->unit_name;
                $efrata_pengeluaran->division_name = $request->division_name;
                $efrata_pengeluaran->updatedBy = $getBy;
                $efrata_pengeluaran->updatedUtc = $getUtc;
                $efrata_pengeluaran->update();

                return response()->json(['status' => 200, 'messages' => 'data berhasil disimpan.']);
            }
            else
            {
                return response()->json(['status' => 400, 'messages' => 'data tidak ditemukan.']);
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
        $efrata_pengeluarans = Efrata_Pengeluaran::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($efrata_pengeluarans)
        {
            $efrata_pengeluarans->deletedBy = $getBy;
            $efrata_pengeluarans->deletedUtc = $getUtc;
            $efrata_pengeluarans->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $efrata_pengeluarans->errors()]);
        }
    }
}
