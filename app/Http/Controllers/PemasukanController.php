<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Budget;
use App\Models\Permintaan;
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

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pemasukans = Pemasukan::with(['permintaans', 'budgets', 'suppliers', 'assets', 'manufactures'])->whereNull('deletedBy')->get();
        $manufactures = Manufacture::all();
        // $categories = Category::all();
        $permintaans = Permintaan::all();
        $budgets = Budget::all();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        if($request->ajax()){
            return DataTables::of($pemasukans)
            ->addIndexColumn()
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
        return view('pemasukan.index', compact('pemasukans', 'permintaans', 'budgets', 'suppliers', 'assets', 'manufactures'));
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
        $permintaans = Permintaan::all();
        $budgets = Budget::all();
        $assets = Asset::all();
        $suppliers = Supplier::all();
        $units = Unit::all();

        $getData = $request->budget_id;

        $getBudgets = Budget::where('id', $getData)->pluck('category_id');

        $getCategories = Category::find($getBudgets)->first();

        return response()->json(['status' => 200, 'manufactures' => $manufactures, 'assets'=> $assets,
                                'suppliers' =>$suppliers, 'budgets' => $budgets, 'permintaans' => $permintaans,
                                'units' => $units, 'getCategories' => $getCategories]);
    }

    // public function getBudgetCategory(Request $request)
    // {
    //     $getData = $request->budget_id;

    //     $budgets = Budget::where('id', $getData)->first();

    //     $categories = Category::with('budgets')->where('category_id', $budgets->category_id)->first();

    //     return response()->json(['status' => 200, 'getData' => $getData]);
    // }

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

        $data = new Pemasukan();
        $data->date = $getDate;
        $data->barcode = $request->input('barcode');
        $data->pemasukan_type = $request->input('pemasukan_type');
        $data->permintaan_id = $request->permintaan_id;
        // $data->status = $request->input('status');
        $data->budget_id = $request->budget_id;
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
        $pemasukans = Pemasukan::with(['permintaans', 'budgets', 'suppliers', 'assets', 'manufactures', 'units'])->where('id', $id)->first();
        $budgets = Budget::with('pemasukans')->where('id', $pemasukans->budget_id)->first();
        $permintaans = Permintaan::with('pemasukans')->where('id', $pemasukans->permintaan_id)->first();
        $units = Unit::with('pemasukans')->where('id', $pemasukans->unit_id)->first();
        $suppliers = Supplier::with('pemasukans')->where('id', $pemasukans->supplier_id)->first();
        $manufactures = Manufacture::with('pemasukans')->where('id', $pemasukans->manufacture_id)->first();
        $permintaansAll = Permintaan::all();
        $suppliersAll = Supplier::all();
        $unitsAll = Unit::all();
        $manufacturesAll = Manufacture::all();
        $budgetAll = Budget::all();

        $getDate = Carbon::createFromFormat('Y-m-d', $pemasukans->date)->format('d-m-Y');

        if($pemasukans){
            return response()->json(['status' => 200, /**'html'=> $html,**/ 'pemasukans' => $pemasukans, 'getDate' => $getDate, 'budgets'=>$budgets,
                                    'permintaans' => $permintaans, 'units'=>$units, 'suppliers' => $suppliers, 'manufactures' => $manufactures,
                                    'permintaansAll' => $permintaansAll, 'suppliersAll' => $suppliersAll, 'unitsAll' => $unitsAll, 'manufacturesAll' => $manufacturesAll, 'budgetAll' => $budgetAll]);
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
            'date' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'400', 'errors'=>$validator->errors()]);
        }
        else
        {
            $pemasukans = Pemasukan::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($pemasukans)
            {
                $pemasukans->date = $getDate;
                $pemasukans->barcode = $request->input('barcode');
                $pemasukans->pemasukan_type = $request->input('pemasukan_type');
                $pemasukans->permintaan_id = $request->permintaan_id;
                // $permintaan->status = $request->input('status');
                $pemasukans->budget_id = $request->budget_id;
                $pemasukans->supplier_id = $request->supplier_id;
                $pemasukans->manufacture_id = $request->manufacture_id;
                $pemasukans->category_type = $request->category_type;
                $pemasukans->category_name = $request->category_name;
                $pemasukans->unit_id = $request->unit_id;
                $pemasukans->replacement_by = $request->replacement_by;
                $pemasukans->barcode = $request->barcode;
                $pemasukans->merk = $request->input('merk');
                $pemasukans->motherboard = $request->input('motherboard');
                $pemasukans->harddisk_slot_1 = $request->input('harddisk_slot_1');
                $pemasukans->harddisk_slot_2 = $request->input('harddisk_slot_2');
                $pemasukans->ram_slot_1 = $request->input('ram_slot_1');
                $pemasukans->ram_slot_2 = $request->input('ram_slot_2');
                $pemasukans->dvd_internal = $request->input('dvd_internal');
                $pemasukans->power_supply = $request->input('power_supply');
                $pemasukans->casing = $request->input('casing');
                $pemasukans->fan_processor = $request->input('fan_processor');
                $pemasukans->id_seri = $request->input('id_seri');
                $pemasukans->no_seri = $request->input('no_seri');

                $pemasukans -> updatedBy = $getBy;
                $pemasukans -> updatedUtc = $getUtc;
                $pemasukans->update();

                return response()->json(['status' => 200, 'messages'=>'data berhasil diperbaharui']);
            }
            else
            {
                return response()->json(['status' => 404, 'messages' => 'data tidak ditemukan']);
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
        $pemasukans = Pemasukan::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();

        if($pemasukans)
        {
            $pemasukans -> deletedBy = $getBy;
            $pemasukans -> deletedUtc = $getUtc;
            $pemasukans -> update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $pemasukans->errors()]);
        }
    }
}
