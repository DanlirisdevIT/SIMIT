<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Company;
use App\Models\Danliris_Pemasukan;
use App\Models\Danliris_Pengeluaran;
use App\Models\Danliris_Permintaan;
use App\Models\Danliris_History;
use App\Models\Danliris_Movement;
use App\Models\Division;
use App\Models\Location;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Danliris_Pengeluaran_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $danliris_pengeluarans = Danliris_Pengeluaran::with(['danliris_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories'])->whereNull('deletedBy')->get();
        $assets = Asset::whereNull('deletedBy')->get();
        $companies = Company::whereNull('deletedBy')->get();
        $divisions = Division::whereNull('deletedBy')->get();
        $units = Unit::whereNull('deletedBy')->get();
        $users = User::whereNull('deletedBy')->get();
        $locations = Location::whereNull('deletedBy')->get();
        $categories = Category::whereNull('deletedBy')->get();
        $danliris_pemasukans = Danliris_Pemasukan::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($danliris_pengeluarans)
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
        return view('pengeluaran.danliris_pengeluaran.index', compact('danliris_pengeluarans', 'danliris_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPemasukan_dl()
    {
        $danliris_pemasukans_1 = Danliris_Pemasukan::whereIn('pemasukan_type', ['to user'])->whereNull('deletedBy')->get();
        $danliris_pemasukans_2 = Danliris_Pemasukan::whereIn('pemasukan_type', ['to it stock', 'replacement'])->whereNull('deletedBy')->get();
        $danliris_pemasukans_3 = Danliris_Pemasukan::whereIn('pemasukan_type', ['replacement'])->whereNull('deletedBy')->get();

        return response()->json(['status' => 200, 'danliris_pemasukans_1' => $danliris_pemasukans_1, 'danliris_pemasukans_2' => $danliris_pemasukans_2, 'danliris_pemasukans_3' => $danliris_pemasukans_3]);
    }

    public function getBarang_dl()
    {
        $getBarang = Asset::whereNull('deletedBy')->get();
        $getCategory = Category::whereNull('deletedBy')->get();
        // $getBarang_category = Category::where('id', $getBarang->category_id)->get();

        return response()->json(['status' => 200, 'getBarang' => $getBarang, 'getCategory' => $getCategory]);
    }

    public function create(Request $request)
    {
        $danliris_pemasukanAll = Danliris_Pemasukan::whereNull('deletedBy')->get();
        $getPemasukan = $request->danliris_pemasukan_id;
        $danliris_pengeluaran = Danliris_Pengeluaran::with(['danliris_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories', 'danliris_permintaans'])->where('id', $getPemasukan)->first();
        $danliris_pemasukan = Danliris_Pemasukan::with('danliris_pengeluarans')->where('id', $getPemasukan)->first();

        // $getUser_id = Danliris_Pemasukan::where('id', $getPemasukan)->pluck('danliris_permintaan_id');
        // $getUser = Danliris_Permintaan::with('danliris_pemasukans')->where('id', $danliris_pemasukan->danliris_permintaan_id)->first();
        // $getUser = Danliris_Permintaan::with('danliris_pemasukans')->where('id', $danliris_pemasukan->danliris_permintaan_id)->first();
        $getUnit = Unit::whereNull('deletedBy')->get();
        $getDivisi = Division::whereNull('deletedBy')->get();

        return response()->json(['status' => 200, 'getPemasukan' => $getPemasukan, 'danliris_pemasukan' => $danliris_pemasukan, 'danliris_pengeluaran' => $danliris_pengeluaran,
                                                'danliris_pemasukanAll' => $danliris_pemasukanAll, 'getUnit' => $getUnit, 'getDivisi' => $getDivisi]);
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
            // 'asset_ip' => 'required|numeric',
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

            $get_barcode = Danliris_Pemasukan::where('id', $request->danliris_pemasukan_id)->pluck('barcode')->first();
            
            // $asset_ip = array();

            // dd($get_barcode);

            if($request->pengeluaran_type == 'to aval')
            {
                $status = 'In Aval';
            }
            else if($request->pengeluaran_type == 'from permintaan' || $request->pengeluaran_type == 'from it stock')
            {
                $status = 'Out IT';
            }

            $data = [
                'date' => $date = $getDate,
                'pengeluaran_type' => $pengeluaran_type = $request->pengeluaran_type,
                'danliris_pemasukan_id' => $danliris_pemasukan_id = $request->danliris_pemasukan_id,
                'category_name' => $category_name = $request->category_name,
                'category_type' => $category_type = $request->category_type,
                'barcode' => $get_barcode,
                'asset_ip' => $asset_ip = $request->input('asset_ip'),
                'asset_name' => $asset_name = $request->asset_name,
                'description' => $description = $request->input('description'),
                'unit_name' => $unit_name = $request->unit_name,
                'username' => $username = $request->username,
                'division_name' => $division_name = $request->division_name,

                'createdBy' => $createdBy = $getBy,
                'createdUtc' => $createdUtc = $getUtc,
            ];
        
            Danliris_Pengeluaran::insert($data);

            // $danliris_movement = Danliris_Movement::where('barcode', $data['barcode'])->first();
            
            // dd($danliris_movement);

            // foreach($asset_ip as $index => $value)
            // {
                Danliris_Movement::where('barcode', $data['barcode'])->update(['asset_ip' => $data['asset_ip'], 'status' => $status, 'updatedUtc' => $getUtc, 'updatedBy' => $getBy]);
                // Danliris_History::where('barcode', $data['barcode'])->update(['asset_ip' => $data['asset_ip'], 'status' => $status, 'updatedUtc' => $getUtc, 'updatedBy' => $getBy]);
            // }

            $data_pengeluaran_history = [
                'tanggal_pengeluaran' => $getDate,
                'asset_name' => $request->asset_name,
                'asset_ip' => $request->asset_ip,
                'barcode' => $get_barcode,
                'username' => $request->username,
                'unit_name' => $request->unit_name,
                'division_name' => $request->division_name,
                'category_name' => $request->category_name,
                'category_type' => $request->category_type,
                'status' => $status,

                'createdBy' => $getBy,
                'createdUtc' => $getUtc
            ];

            $input_histories[] = $data_pengeluaran_history;

            Danliris_History::insert($input_histories);

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
        $danliris_pengeluarans = Danliris_Pengeluaran::with(['danliris_pemasukans', 'assets', 'companies', 'divisions', 'units', 'users', 'locations', 'categories', 'danliris_permintaans'])->where('id', $id)->first();
        $danliris_pemasukans = Danliris_Pemasukan::with('danliris_pengeluarans')->where('id', $danliris_pengeluarans->danliris_pemasukan_id)->first();

        return response()->json(['status' => 200, 'danliris_pengeluarans' => $danliris_pengeluarans, 'danliris_pemasukans' => $danliris_pemasukans]);
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
            // 'asset_ip' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $danliris_pengeluaran = Danliris_Pengeluaran::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->date)->format('Y-m-d');

            if($danliris_pengeluaran)
            {
                // $danliris_pengeluaran->date = $getDate;
                // $danliris_pengeluaran->pengeluaran_type = $request->pengeluaran_type;
                // $danliris_pengeluaran->danliris_pemasukan_id = $request->danliris_pemasukan_id;
                // $danliris_pengeluaran->category_name = $request->category_name;
                // $danliris_pengeluaran->category_type = $request->category_type;
                // $danliris_pengeluaran->barcode = $request->barcode;
                // $danliris_pengeluaran->asset_ip = $request->input('asset_ip');
                // $danliris_pengeluaran->quantity = $request->input('quantity');
                // $danliris_pengeluaran->description = $request->input('description');
                // $danliris_pengeluaran->username = $request->username;
                // $danliris_pengeluaran->unit_name = $request->unit_name;
                // $danliris_pengeluaran->division_name = $request->division_name;
                // $danliris_pengeluaran->updatedBy = $getBy;
                // $danliris_pengeluaran->updatedUtc = $getUtc;
                // $danliris_pengeluaran->update();

                $data = [
                    'date' => $date = $getDate,
                    'pengeluaran_type' => $pengeluaran_type = $request->pengeluaran_type,
                    'danliris_pemasukan_id' => $danliris_pemasukan_id = $request->danliris_pemasukan_id,
                    'category_name' => $category_name = $request->category_name,
                    'category_type' => $category_type = $request->category_type,
                    'barcode' => $barcode = $request->barcode,
                    'asset_ip' => $asset_ip = $request->input('asset_ip'),
                    // 'quantity' => $quantity = $request->input('quantity'),
                    'description' => $description = $request->input('description'),
                    'unit_name' => $unit_name = $request->unit_name,
                    'username' => $username = $request->username,
                    'division_name' => $division_name = $request->division_name,
    
                    'updatedBy' => $updatedBy = $getBy,
                    'updatedUtc' => $updatedUtc = $getUtc,
                ];

                Danliris_Pengeluaran::where('id', $id)->update($data);

                Danliris_Movement::where('barcode', $data['barcode'])->update(['asset_ip' => $data['asset_ip'], 'updatedUtc' => $getUtc, 'updatedBy' => $getBy]);

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
        $danliris_pengeluarans = Danliris_Pengeluaran::find($id);
        $danliris_movements = Danliris_Movement::find($id);
        $danliris_histories = Danliris_History::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($danliris_pengeluarans)
        {
            $danliris_pengeluarans->deletedBy = $getBy;
            $danliris_pengeluarans->deletedUtc = $getUtc;
            $danliris_pengeluarans->update();

            $danliris_movements->deletedBy = $getBy;
            $danliris_movements->deletedUtc = $getUtc;
            $danliris_movements->update();

            $danliris_histories->deletedBy = $getBy;
            $danliris_histories->deletedUtc = $getUtc;
            $danliris_histories->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $danliris_pengeluarans->errors()]);
        }
    }
}
