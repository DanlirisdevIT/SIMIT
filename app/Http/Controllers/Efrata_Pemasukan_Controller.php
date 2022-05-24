<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Efrata_Pemasukan;
use App\Models\Efrata_Permintaan;
use App\Models\Efrata_budget;
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

class Efrata_Pemasukan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_pemasukans = Efrata_Pemasukan::with(['efrata_permintaans', 'efrata_budgets', 'suppliers', 'assets', 'manufactures'])->whereNull('deletedBy')->get();
        $manufactures = Manufacture::all();
        // $categories = Category::all();
        $efrata_permintaans = Efrata_Permintaan::all();
        $efrata_budgets = efrata_Budget::all();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        if($request->ajax()){
            return DataTables::of($efrata_pemasukans)
            ->addIndexColumn()
            ->addColumn('user', function($data) {
                if($data->efrata_permintaan_id == null){
                    return $data->replacement_by;
                }
                else
                {
                    $getUsername = Efrata_Permintaan::where('id', $data->efrata_permintaan_id)->pluck('username')->first();
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
        return view('pemasukan.efrata_pemasukan.index', compact('efrata_pemasukans', 'efrata_permintaans', 'efrata_budgets', 'suppliers', 'assets', 'manufactures'));
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
        $efrata_permintaans = Efrata_Permintaan::all();
        $efrata_budgets = Efrata_Budget::all();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        $units = Unit::all();

        $getData = $request->efrata_budget_id;

        $getBudgets = Efrata_Budget::where('id', $getData)->pluck('category_id');

        $getCategories = Category::find($getBudgets)->first();

        return response()->json(['status' => 200, 'manufactures' => $manufactures, 'assets'=> $assets,
                                'suppliers' =>$suppliers, 'efrata_budgets' => $efrata_budgets, 'efrata_permintaans' => $efrata_permintaans,
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
        $efrata_uid = Helper::IDGenerator(new Efrata_Pemasukan(), 'ef_uid', 'EF-IN', 5);

        $data = new Efrata_Pemasukan();
        // $data->ef_uid = $efrata_uid;
        $data->date = $getDate;
        $data->barcode = $request->input('barcode');
        $data->pemasukan_type = $request->input('pemasukan_type');
        $data->efrata_permintaan_id = $request->efrata_permintaan_id;
        // $data->status = $request->input('status');
        $data->efrata_budget_id = $request->efrata_budget_id;
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
        $efrata_pemasukans = Efrata_Pemasukan::with(['efrata_permintaans', 'efrata_budgets', 'suppliers', 'assets', 'manufactures', 'units'])->where('id', $id)->first();
        $efrata_budgets = Efrata_Budget::with('efrata_pemasukans')->where('id', $efrata_pemasukans->efrata_budget_id)->first();
        $efrata_permintaans = Efrata_Permintaan::with('efrata_pemasukans')->where('id', $efrata_pemasukans->efrata_permintaan_id)->first();
        $units = Unit::with('efrata_pemasukans')->where('id', $efrata_pemasukans->unit_id)->first();
        $suppliers = Supplier::with('efrata_pemasukans')->where('id', $efrata_pemasukans->supplier_id)->first();
        $manufactures = Manufacture::with('efrata_pemasukans')->where('id', $efrata_pemasukans->manufacture_id)->first();
        $efrata_permintaansAll = Efrata_Permintaan::all();
        $suppliersAll = Supplier::all();
        $unitsAll = Unit::all();
        $manufacturesAll = Manufacture::all();
        $efrata_budgetAll = Efrata_Budget::all();

        $getDate = Carbon::createFromFormat('Y-m-d', $efrata_pemasukans->date)->format('d/m/Y');
        // $getDate = Carbon::parse($efrata_pemasukans->date)->format('d/m/Y');

        if($efrata_pemasukans){
            return response()->json(['status' => 200, /**'html'=> $html,**/ 'efrata_pemasukans' => $efrata_pemasukans, 'getDate' => $getDate, 'efrata_budgets'=>$efrata_budgets,
                                    'efrata_permintaans' => $efrata_permintaans, 'units'=>$units, 'suppliers' => $suppliers, 'manufactures' => $manufactures,
                                    'efrata_permintaansAll' => $efrata_permintaansAll, 'suppliersAll' => $suppliersAll, 'unitsAll' => $unitsAll, 'manufacturesAll' => $manufacturesAll, 'efrata_budgetAll' => $efrata_budgetAll]);
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
            $efrata_pemasukan = Efrata_Pemasukan::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->date)->format('Y-m-d');

            if($efrata_pemasukan)
            {
                $efrata_pemasukan->ef_uid = $request->ef_uid;
                $efrata_pemasukan->date = $getDate;
                $efrata_pemasukan->barcode = $request->input('barcode');
                $efrata_pemasukan->pemasukan_type = $request->pemasukan_type;
                $efrata_pemasukan->replacement_by = $request->replacement_by;
                $efrata_pemasukan->category_name = $request->category_name;
                $efrata_pemasukan->category_type = $request->category_type;
                $efrata_pemasukan->efrata_permintaan_id = $request->efrata_permintaan_id;
                $efrata_pemasukan->efrata_budget_id = $request->efrata_budget_id;
                $efrata_pemasukan->supplier_id = $request->supplier_id;
                $efrata_pemasukan->asset_id = $request->asset_id;
                $efrata_pemasukan->manufacture_id = $request->manufacture_id;
                $efrata_pemasukan->unit_id = $request->unit_id;
                $efrata_pemasukan->merk = $request->input('merk');
                $efrata_pemasukan->motherboard = $request->input('motherboard');
                $efrata_pemasukan->processor = $request->input('processor');
                $efrata_pemasukan->power_supply = $request->input('power_supply');
                $efrata_pemasukan->casing = $request->input('casing');
                $efrata_pemasukan->harddisk_slot_1 = $request->input('harddisk_slot_1');
                $efrata_pemasukan->harddisk_slot_2 = $request->input('harddisk_slot_2');
                $efrata_pemasukan->ram_slot_1 = $request->input('ram_slot_1');
                $efrata_pemasukan->ram_slot_2 = $request->input('ram_slot_2');
                $efrata_pemasukan->fan_processor = $request->input('fan_processor');
                $efrata_pemasukan->dvd_internal = $request->input('dvd_internal');
                $efrata_pemasukan->id_seri = $request->input('id_seri');
                $efrata_pemasukan->no_seri = $request->input('no_seri');
                $efrata_pemasukan->updatedBy = $getBy;
                $efrata_pemasukan->updatedUtc = $getUtc;
                $efrata_pemasukan->update();

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
        $efrata_pemasukans = Efrata_Pemasukan::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($efrata_pemasukans)
        {
            $efrata_pemasukans -> deletedBy = $getBy;
            $efrata_pemasukans -> deletedUtc = $getUtc;
            $efrata_pemasukans -> update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $efrata_pemasukans->errors()]);
        }
    }
}
