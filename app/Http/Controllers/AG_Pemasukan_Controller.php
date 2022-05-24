<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AG_Pemasukan;
use App\Models\AG_budget;
use App\Models\AG_Permintaan;
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

class AG_Pemasukan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ag_pemasukans = AG_Pemasukan::with(['ag_permintaans', 'ag_budgets', 'suppliers', 'assets', 'manufactures'])->whereNull('deletedBy')->get();
        $manufactures = Manufacture::all();
        // $categories = Category::all();
        $ag_permintaans = AG_Permintaan::all();
        $ag_budgets = AG_Budget::all();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        if($request->ajax()){
            return DataTables::of($ag_pemasukans)
            ->addIndexColumn()
            ->addColumn('user', function($data) {
                if($data->ag_permintaan_id == null){
                    return $data->replacement_by;
                }
                else
                {
                    $getUsername = AG_Permintaan::where('id', $data->ag_permintaan_id)->pluck('username')->first();
                    return $getUsername;
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
        return view('pemasukan.ag_pemasukan.index', compact('ag_pemasukans', 'ag_permintaans', 'ag_budgets', 'suppliers', 'assets', 'manufactures'));
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
        $ag_permintaans = AG_Permintaan::all();
        $ag_budgets = AG_Budget::all();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        $units = Unit::all();

        $getData = $request->ag_budget_id;

        $getBudgets = AG_Budget::where('id', $getData)->pluck('category_id');

        $getCategories = Category::find($getBudgets)->first();

        return response()->json(['status' => 200, 'manufactures' => $manufactures, 'assets'=> $assets,
                                'suppliers' =>$suppliers, 'ag_budgets' => $ag_budgets, 'ag_permintaans' => $ag_permintaans,
                                'units' => $units, 'getCategories' => $getCategories]);
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
        $ag_uid = Helper::IDGenerator(new AG_Pemasukan(), 'ag_uid', 'AG-IN', 5);

        $data = new AG_Pemasukan();
        // $data->ag_uid = $ag_uid;
        $data->date = $getDate;
        $data->barcode = $request->input('barcode');
        $data->pemasukan_type = $request->input('pemasukan_type');
        $data->ag_permintaan_id = $request->ag_permintaan_id;
        // $data->status = $request->input('status');
        $data->ag_budget_id = $request->ag_budget_id;
        $data->supplier_id = $request->supplier_id;
        $data->manufacture_id = $request->manufacture_id;
        $data->category_type = $request->category_type;
        $data->category_name = $request->category_name;
        $data->unit_id = $request->unit_id;
        $data->replacement_by = $request->replacement_by;
        $data->barcode = $request->barcode;
        $data->merk = $request->input('merk');
        $data->motherboard = $request->input('motherboard');
        $data->harddisk_slot_1 = $request->input('harddisk_slot_1');
        $data->harddisk_slot_2 = $request->input('harddisk_slot_2');
        $data->ram_slot_1 = $request->input('ram_slot_1');
        $data->ram_slot_2 = $request->input('ram_slot_2');
        $data->dvd_internal = $request->input('dvd_internal');
        $data->power_supply = $request->input('power_supply');
        $data->casing = $request->input('casing');
        $data->fan_processor = $request->input('fan_processor');
        $data->id_seri = $request->input('id_seri');
        $data->no_seri = $request->input('no_seri');

        $data -> createdBy = $getBy;
        $data -> createdUtc = $getUtc;
        $data->save();

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
        $ag_pemasukans = AG_Pemasukan::with(['ag_permintaans', 'ag_budgets', 'suppliers', 'assets', 'manufactures', 'units'])->where('id', $id)->first();
        $ag_budgets = AG_Budget::with('ag_pemasukans')->where('id', $ag_pemasukans->ag_budget_id)->first();
        $ag_permintaans = AG_Permintaan::with('ag_pemasukans')->where('id', $ag_pemasukans->ag_permintaan_id)->first();
        $units = Unit::with('ag_pemasukans')->where('id', $ag_pemasukans->unit_id)->first();
        $suppliers = Supplier::with('ag_pemasukans')->where('id', $ag_pemasukans->supplier_id)->first();
        $manufactures = Manufacture::with('ag_pemasukans')->where('id', $ag_pemasukans->manufacture_id)->first();
        $ag_permintaansAll = AG_Permintaan::all();
        $suppliersAll = Supplier::all();
        $unitsAll = Unit::all();
        $manufacturesAll = Manufacture::all();
        $ag_budgetAll = AG_Budget::all();

        $getDate = Carbon::createFromFormat('Y-m-d', $ag_pemasukans->date)->format('d/m/Y');
        // $getDate = Carbon::parse($ag_pemasukans->date)->format('d/m/Y');

        if($ag_pemasukans){
            return response()->json(['status' => 200, /**'html'=> $html,**/ 'ag_pemasukans' => $ag_pemasukans, 'getDate' => $getDate, 'ag_budgets'=>$ag_budgets,
                                    'ag_permintaans' => $ag_permintaans, 'units'=>$units, 'suppliers' => $suppliers, 'manufactures' => $manufactures,
                                    'ag_permintaansAll' => $ag_permintaansAll, 'suppliersAll' => $suppliersAll, 'unitsAll' => $unitsAll, 'manufacturesAll' => $manufacturesAll, 'ag_budgetAll' => $ag_budgetAll]);
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
            $ag_pemasukan = AG_Pemasukan::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->date)->format('Y-m-d');

            if($ag_pemasukan)
            {
                $ag_pemasukan->ag_uid = $request->ag_uid;
                $ag_pemasukan->date = $getDate;
                $ag_pemasukan->barcode = $request->input('barcode');
                $ag_pemasukan->pemasukan_type = $request->pemasukan_type;
                $ag_pemasukan->replacement_by = $request->replacement_by;
                $ag_pemasukan->category_name = $request->category_name;
                $ag_pemasukan->category_type = $request->category_type;
                $ag_pemasukan->ag_permintaan_id = $request->ag_permintaan_id;
                $ag_pemasukan->ag_budget_id = $request->ag_budget_id;
                $ag_pemasukan->supplier_id = $request->supplier_id;
                $ag_pemasukan->asset_id = $request->asset_id;
                $ag_pemasukan->manufacture_id = $request->manufacture_id;
                $ag_pemasukan->unit_id = $request->unit_id;
                $ag_pemasukan->merk = $request->input('merk');
                $ag_pemasukan->motherboard = $request->input('motherboard');
                $ag_pemasukan->processor = $request->input('processor');
                $ag_pemasukan->power_supply = $request->input('power_supply');
                $ag_pemasukan->casing = $request->input('casing');
                $ag_pemasukan->harddisk_slot_1 = $request->input('harddisk_slot_1');
                $ag_pemasukan->harddisk_slot_2 = $request->input('harddisk_slot_2');
                $ag_pemasukan->ram_slot_1 = $request->input('ram_slot_1');
                $ag_pemasukan->ram_slot_2 = $request->input('ram_slot_2');
                $ag_pemasukan->fan_processor = $request->input('fan_processor');
                $ag_pemasukan->dvd_internal = $request->input('dvd_internal');
                $ag_pemasukan->id_seri = $request->input('id_seri');
                $ag_pemasukan->no_seri = $request->input('no_seri');
                $ag_pemasukan->updatedBy = $getBy;
                $ag_pemasukan->updatedUtc = $getUtc;
                $ag_pemasukan->update();

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
        $ag_pemasukans = AG_Pemasukan::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($ag_pemasukans)
        {
            $ag_pemasukans -> deletedBy = $getBy;
            $ag_pemasukans -> deletedUtc = $getUtc;
            $ag_pemasukans -> update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $ag_pemasukans->errors()]);
        }
    }
}
