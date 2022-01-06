<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Budget;
use App\Models\Division;
use App\Models\Permintaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $budgets = Budget::with(['permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        $permintaans = Permintaan::all();
        $divisions = Division::all();
        $categories = Category::all();
        $assets = Asset::all();
        if($request->ajax()){
            return DataTables::of($budgets)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editBudget"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" unit_name="'.$data->unit_name.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUnit"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('budget.index', compact('permintaans' ,'divisions', 'categories', 'assets'));
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
            'group' => 'required',
            'quantity' => 'required',
            'unitPrice' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->level;
            $createdUtc = Carbon::now();

            $data = new Budget();
            $data->permintaan_id = $request->permintaan_id;
            $data -> group = $request->input('group');
            $data->division_id = $request->division_id;
            $data->category_id = $request->category_id;
            $data->asset_id = $request->asset_id;
            $data -> quantity = $request->input('quantity');
            $data -> unitPrice = $request->input('unitPrice');
            $data -> description = $request->input('description');
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

             return response()->json(['status'=>200, 'messages'=>'Data berhasil ditambahkan.']);
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
        $budgets = Budget::with(['permintaans' ,'divisions', 'categories', 'assets'])->where('id', $id)->first();
        $permintaans = Permintaan::with('budgets')->where('id', $budgets->permintaan_id)->first();
        $divisions = Division::with('budgets')->where('id', $budgets->division_id)->first();
        $categories = Category::with('budgets')->where('id', $budgets->company_id)->first();
        $assets = Asset::with('budgets')->where('id', $budgets->asset_id)->first();
        if($budgets)
        {
            return response()->json(['status' => 200, 'budgets' => $budgets, 'permintaans' => $permintaans, 'divisions' => $divisions, 'categories' => $categories, 'assets' => $assets]);
        }
        else
        {
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
            'group'=>'required',
            'unitPrice'=>'required',
            'description'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $budgets = Budget::find($id);
            if($budgets)
            {
                $budgets->permintaan_id=$request->permintaan_id;
                $budgets->group=$request->input('group');
                $budgets->division_id=$request->division_id;
                $budgets->category_id=$request->category_id;
                $budgets->asset_id=$request->asset_id;
                $budgets->quantity=$request->input('quantity');
                $budgets->unitPrice=$request->input('unitPrice');
                $budgets->description=$request->input('description');
                $budgets->updatedBy=$getBy;
                $budgets->updatedUtc=$getUtc;
                $budgets->update();
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
        $budgets = Budget::find($id);
        if($budgets)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $budgets->deletedBy = $getBy;
            $budgets->deletedUtc = $getUtc;
            $budgets->update();

            return response()->json(['status' => 200, 'messages' => 'Data sudah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
