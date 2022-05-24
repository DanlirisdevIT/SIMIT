<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Danliris_Pemasukan;
use App\Models\Danliris_budget;
use App\Models\Danliris_Permintaan;
use App\Models\Danliris_Movement;
use App\Models\Manufacture;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Asset;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Helper;

class Danliris_Pemasukan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $danliris_pemasukans = Danliris_Pemasukan::with(['danliris_permintaans', 'danliris_budgets', 'suppliers', 'assets', 'manufactures'])->whereNull('deletedBy')->get();
        $manufactures = Manufacture::whereNull('deletedBy')->get();
        // $categories = Category::all();
        $danliris_permintaans = Danliris_Permintaan::whereNull('deletedBy')->get();
        $danliris_budgets = Danliris_Budget::whereNull('deletedBy')->get();
        $assets = Asset::whereNull('deletedBy')->get();
        $suppliers = Supplier::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($danliris_pemasukans)
            ->addIndexColumn()
            ->addColumn('user', function($data) {
                if($data->user_peminta == null){
                    return $data->replacement_by;
                }
                else
                {
                    // $getUsername = Danliris_Permintaan::where('id', $data->danliris_permintaan_id)->pluck('username')->first();
                    return $data->user_peminta;
                }
            })
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editPemasukan"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" asset_name="'.$data->asset_name.'" model_number="'.$data->model_number.'" EOL="'.$data->EOL.'"  data-original-title="Delete" class="btn btn-danger btn-sm deleteAsset"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pemasukan.danliris_pemasukan.index', compact('danliris_pemasukans', 'danliris_permintaans', 'danliris_budgets', 'suppliers', 'assets', 'manufactures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $manufactures = Manufacture::all();
        // $categories = Category::all();
        $danliris_budgets = Danliris_Budget::whereNull('deletedBy')->get();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        $units = Unit::all();

        $getData = $request->danliris_budget_id;

        $getBudgetCategories = Danliris_Budget::where('id', $getData)->pluck('category_id');
        
        $getBudgetAssets = Danliris_Budget::where('id', $getData)->pluck('asset_id');
        
        $getBudgetPermintaans = Danliris_Budget::where('id', $getData)->pluck('danliris_permintaan_id');

        $getBudgets = Danliris_Budget::where('id', $getData)
                                        ->whereNull('deletedBy')
                                        ->first();

        $get_danliris_permintaans = Danliris_Permintaan::find($getBudgetPermintaans)->first();

        $getCategories = Category::find($getBudgetCategories)->first();

        $getAssets = Asset::find($getBudgetAssets)->first();

        return response()->json(['status' => 200, 'manufactures' => $manufactures, 'assets'=> $assets,
                                'suppliers' =>$suppliers, 'danliris_budgets' => $danliris_budgets, 'get_danliris_permintaans' => $get_danliris_permintaans,
                            'units' => $units, 'getCategories' => $getCategories, 'getBudgets' => $getBudgets, 'getAssets' => $getAssets]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
        // $danliris_uid = Helper::IDGenerator(new Danliris_Pemasukan(), 'dl_uid', 'DL-IN', 5);

        $date = $getDate;
        $input = $request->all();
        $pemasukan_type = $request->input('pemasukan_type');
        $user_permintaan = $request->user_permintaan;
        $danliris_budget_id = $request->danliris_budget_id;
        $supplier_id = $request->supplier_id;
        $manufacture_id = $request->manufacture_id;
        $category_type = $request->category_type;
        $category_name = $request->category_name;
        $asset_name = $request->asset_name;
        $unit_id = $request->unit_id;
        $replacement_by = $request->replacement_by;
        $quantity = $request->quantity;
        // $barcode = random_int(000000, 999999);
        $merk = $request->input('merk');
        $motherboard = $request->input('motherboard');
        $harddisk_slot_1 = $request->input('harddisk_slot_1');
        $harddisk_slot_2 = $request->input('harddisk_slot_2');
        $ram_slot_1 = $request->input('ram_slot_1');
        $ram_slot_2 = $request->input('ram_slot_2');
        $dvd_internal = $request->input('dvd_internal');
        $power_supply = $request->input('power_supply');
        $casing = $request->input('casing');
        $fan_processor = $request->input('fan_processor');
        $id_seri = $request->input('id_seri');
        $no_seri = $request->input('no_seri');

        $createdBy = $getBy;
        $createdUtc = $getUtc;

        // $asset_id = Danliris_Budget::where(fn($query) => $query->where('id', '=', $danliris_budget_id))->pluck('asset_id');
        // $asset_id = Danliris_Budget::where('id', $danliris_budget_id)->pluck('asset_id')->first();
        // $asset_id = $request->asset_id;
        $quantity = $request->quantity;
        $user = Auth::user()->id;
        
        if($request->pemasukan_type == 'to user')
        {
            $status = 'In';
        }
        else if($request->pemasukan_type == 'to it stock' || $request->pemasukan_type == 'replacement')
        {
            $status = 'In IT';
        }

        $barcodes = array();
        for($i=1; $i<=$quantity; $i++)
        {
            $barcodes[] = random_int(000000, 999999);    
        }

        foreach($barcodes as $i => $value)
        {
            $data_pemasukan = [
                'date' => $getDate = Carbon::parse($request->input('date'))->format('Y-m-d'),
                'pemasukan_type' => $request->pemasukan_type,
                'user_peminta' => $request->user_permintaan,
                'danliris_budget_id' => $request->danliris_budget_id,
                'supplier_id' => $request->supplier_id,
                'manufacture_id' => $request->manufacture_id,
                'category_type' => $request->category_type,
                'category_name' => $request->category_name,
                'asset_name' => $request->asset_name,
                'unit_id' => $request->unit_id,
                'replacement_by'=> $replacement_by = !empty($replacement_by) ? $replacement_by : "",
                // 'quantity' => $quantity,
                'barcode' => $value,
                'merk' => !empty($merk) ? $merk : "",
                'motherboard' => !empty($motherboard) ? $motherboard : "",
                'harddisk_slot_1' => !empty($harddisk_slot_1) ? $harddisk_slot_1 : "",
                'harddisk_slot_2' => !empty($harddisk_slot_2) ? $harddisk_slot_2 : "",
                'ram_slot_1' => !empty($ram_slot_1) ? $ram_slot_1 : "",
                'ram_slot_2' => !empty($ram_slot_2) ? $ram_slot_2 : "",
                'dvd_internal' => !empty($dvd_internal) ? $dvd_internal : "",
                'power_supply' => !empty($power_supply) ? $power_supply : "",
                'casing' => !empty($casing) ? $casing : "",
                'fan_processor' => !empty($fan_processor) ? $fan_processor : "",
                'id_seri' => !empty($id_seri) ? $id_seri : "",
                'no_seri' => !empty($no_seri) ? $no_seri : "",

                'createdBy' => $createdBy = Auth::user()->name,
                'createdUtc' => $createdUtc = Carbon::now()

            ];

            $input_pemasukan[] = $data_pemasukan;

        }

        Danliris_Pemasukan::insert($input_pemasukan);

        foreach($barcodes as $i => $value)
        {
            $data_movement = [
                'asset_name' => $request->asset_name,
                'barcode' => $value,
                // 'quantity' => $request->quantity,
                'user_id' => $user,
                'status' => $status,
                'createdBy' => $createdBy,
                'createdUtc' => $createdUtc,
            ];

            $input_movement[] = $data_movement;
        }

        Danliris_Movement::insert($input_movement);

        return response()->json(['status'=>200, 'messages'=>'Data telah ditambahkan']);
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
        $danliris_pemasukans = Danliris_Pemasukan::with(['danliris_permintaans', 'danliris_budgets', 'suppliers', 'assets', 'manufactures', 'units'])->where('id', $id)->first();
        $danliris_budgets = Danliris_Budget::with('danliris_pemasukans')->where('id', $danliris_pemasukans->danliris_budget_id)->first();
        // $danliris_permintaans = Danliris_Permintaan::with('danliris_pemasukans')->where('id', $danliris_pemasukans->danliris_permintaan_id)->first();
        $units = Unit::with('danliris_pemasukans')->where('id', $danliris_pemasukans->unit_id)->first();
        $suppliers = Supplier::with('danliris_pemasukans')->where('id', $danliris_pemasukans->supplier_id)->first();
        $manufactures = Manufacture::with('danliris_pemasukans')->where('id', $danliris_pemasukans->manufacture_id)->first();
        $danliris_permintaansAll = Danliris_Permintaan::all();
        $suppliersAll = Supplier::all();
        $unitsAll = Unit::all();
        $manufacturesAll = Manufacture::all();
        $danliris_budgetAll = Danliris_Budget::all();

        $getDate = Carbon::createFromFormat('Y-m-d', $danliris_pemasukans->date)->format('d/m/Y');
        // $getDate = Carbon::parse($danliris_pemasukans->date)->format('d/m/Y');

        if($danliris_pemasukans){
            return response()->json(['status' => 200, /**'html'=> $html,**/ 'danliris_pemasukans' => $danliris_pemasukans, 'getDate' => $getDate, 'danliris_budgets'=>$danliris_budgets,
                                    'units'=>$units, 'suppliers' => $suppliers, 'manufactures' => $manufactures,
                                    'danliris_permintaansAll' => $danliris_permintaansAll, 'suppliersAll' => $suppliersAll, 'unitsAll' => $unitsAll, 'manufacturesAll' => $manufacturesAll, 'danliris_budgetAll' => $danliris_budgetAll]);
        }else{
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan']);
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
            'date' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $danliris_pemasukan = Danliris_Pemasukan::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->date)->format('Y-m-d');

            if($danliris_pemasukan)
            {
                // $danliris_pemasukan->dl_uid = $request->dl_uid;
                $danliris_pemasukan->date = $getDate;
                $danliris_pemasukan->barcode = $request->input('barcode');
                $danliris_pemasukan->pemasukan_type = $request->pemasukan_type;
                $danliris_pemasukan->replacement_by = $request->replacement_by;
                $danliris_pemasukan->category_name = $request->category_name;
                $danliris_pemasukan->category_type = $request->category_type;
                // $danliris_pemasukan->danliris_permintaan_id = $request->danliris_permintaan_id;
                $danliris_pemasukan->danliris_budget_id = $request->danliris_budget_id;
                $danliris_pemasukan->supplier_id = $request->supplier_id;
                $danliris_pemasukan->asset_id = $request->asset_id;
                $danliris_pemasukan->manufacture_id = $request->manufacture_id;
                $danliris_pemasukan->unit_id = $request->unit_id;
                $danliris_pemasukan->merk = $request->input('merk');
                $danliris_pemasukan->motherboard = $request->input('motherboard');
                $danliris_pemasukan->processor = $request->input('processor');
                $danliris_pemasukan->power_supply = $request->input('power_supply');
                $danliris_pemasukan->casing = $request->input('casing');
                $danliris_pemasukan->harddisk_slot_1 = $request->input('harddisk_slot_1');
                $danliris_pemasukan->harddisk_slot_2 = $request->input('harddisk_slot_2');
                $danliris_pemasukan->ram_slot_1 = $request->input('ram_slot_1');
                $danliris_pemasukan->ram_slot_2 = $request->input('ram_slot_2');
                $danliris_pemasukan->fan_processor = $request->input('fan_processor');
                $danliris_pemasukan->dvd_internal = $request->input('dvd_internal');
                $danliris_pemasukan->id_seri = $request->input('id_seri');
                $danliris_pemasukan->no_seri = $request->input('no_seri');
                $danliris_pemasukan->updatedBy = $getBy;
                $danliris_pemasukan->updatedUtc = $getUtc;
                $danliris_pemasukan->update();

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
        $danliris_pemasukans = Danliris_Pemasukan::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($danliris_pemasukans)
        {
            $danliris_pemasukans -> deletedBy = $getBy;
            $danliris_pemasukans -> deletedUtc = $getUtc;
            $danliris_pemasukans -> update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $danliris_pemasukans->errors()]);
        }
    }
}
