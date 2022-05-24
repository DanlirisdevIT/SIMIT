<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Company;
use App\Models\ag_Pemasukan;
use App\Models\ag_Pengeluaran;
use App\Models\ag_Permintaan;
use App\Models\Division;
use App\Models\Location;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AG_Pengeluaran_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ag_pengeluarans = AG_Pengeluaran::with(['ag_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories'])->whereNull('deletedBy')->get();
        $assets = Asset::all();
        $companies = Company::all();
        $divisions = Division::all();
        $units = Unit::all();
        $users = User::all();
        $locations = Location::all();
        $categories = Category::all();
        $ag_pemasukans = AG_Pemasukan::all();

        if($request->ajax()){
            return DataTables::of($ag_pengeluarans)
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
        return view('pengeluaran.ag_pengeluaran.index', compact('ag_pengeluarans', 'ag_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories'));
    }

    public function getPemasukan_ag()
    {
        $ag_pemasukans_1 = AG_Pemasukan::whereNotIn('pemasukan_type', ['to it stock', 'replacement'])->whereNull('deletedBy')->get();
        $ag_pemasukans_2 = AG_Pemasukan::whereNotIn('pemasukan_type', ['to user', 'replacement'])->whereNull('deletedBy')->get();
        $ag_pemasukans_3 = AG_Pemasukan::whereNotIn('pemasukan_type', ['to user', 'to_it_stock'])->whereNull('deletedBy')->get();

        return response()->json(['status' => 200, 'ag_pemasukans_1' => $ag_pemasukans_1, 'ag_pemasukans_2' => $ag_pemasukans_2, 'ag_pemasukans_3' => $ag_pemasukans_3]);
    }

    public function getBarang_ag()
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
        $ag_pemasukanAll = AG_Pemasukan::all();
        $getPemasukan = $request->ag_pemasukan_id;
        $ag_pengeluaran = AG_Pengeluaran::with(['ag_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories', 'ag_permintaans'])->where('id', $getPemasukan)->first();
        $ag_pemasukan = AG_Pemasukan::with('ag_pengeluarans')->where('id', $getPemasukan)->first();

        // $getUser_id = ag_Pemasukan::where('id', $getPemasukan)->pluck('ag_permintaan_id');
        $getUser = AG_Permintaan::find($ag_pemasukan)->first();
        $getUnit = Unit::find($ag_pemasukan)->first();
        $getDivisi = Division::find($ag_pemasukan)->first();

        return response()->json(['status' => 200, 'getPemasukan' => $getPemasukan, 'ag_pemasukan' => $ag_pemasukan, 'ag_pengeluaran' => $ag_pengeluaran,
                                                'getUser' => $getUser, 'ag_pemasukanAll' => $ag_pemasukanAll, 'getUnit' => $getUnit, 'getDivisi' => $getDivisi]);

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

            $data = new AG_Pengeluaran();
            $data->date = $getDate;
            $data->pengeluaran_type = $request->pengeluaran_type;
            $data->ag_pemasukan_id = $request->ag_pemasukan_id;
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
        $ag_pengeluarans = AG_Pengeluaran::with(['ag_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories', 'ag_permintaans'])->where('id', $id)->first();
        $ag_pemasukans = AG_Pemasukan::with('ag_pengeluarans')->where('id', $ag_pengeluarans->ag_pemasukan_id)->first();

        return response()->json(['status' => 200, 'ag_pengeluarans' => $ag_pengeluarans, 'ag_pemasukans' => $ag_pemasukans]);

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
            $ag_pengeluaran = AG_Pengeluaran::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->date)->format('Y-m-d');

            if($ag_pengeluaran)
            {
                $ag_pengeluaran->date = $getDate;
                $ag_pengeluaran->pengeluaran_type = $request->pengeluaran_type;
                $ag_pengeluaran->ag_pemasukan_id = $request->ag_pemasukan_id;
                $ag_pengeluaran->category_name = $request->category_name;
                $ag_pengeluaran->category_type = $request->category_type;
                $ag_pengeluaran->barcode = $request->barcode;
                $ag_pengeluaran->asset_ip = $request->input('asset_ip');
                $ag_pengeluaran->quantity = $request->input('quantity');
                $ag_pengeluaran->description = $request->input('description');
                $ag_pengeluaran->username = $request->username;
                $ag_pengeluaran->unit_name = $request->unit_name;
                $ag_pengeluaran->division_name = $request->division_name;
                $ag_pengeluaran->updatedBy = $getBy;
                $ag_pengeluaran->updatedUtc = $getUtc;
                $ag_pengeluaran->update();

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
        $ag_pengeluarans = AG_Pengeluaran::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($ag_pengeluarans)
        {
            $ag_pengeluarans->deletedBy = $getBy;
            $ag_pengeluarans->deletedUtc = $getUtc;
            $ag_pengeluarans->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $ag_pengeluarans->errors()]);
        }
    }
}
