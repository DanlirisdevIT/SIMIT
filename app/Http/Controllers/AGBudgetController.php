<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\AG_budget;
use App\Models\Division;
use App\Models\AG_Permintaan;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AGBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $budgets = Budget::with(['permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        $ag_budgets = AG_budget::with(['ag_permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        // $permintaans = Permintaan::all();
        $ag_permintaans = AG_Permintaan::all();
        $divisions = Division::all();
        $categories = Category::all();
        $assets = Asset::all();
        if($request->ajax()){
            return DataTables::of($ag_budgets)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editBudget"><i class="far fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('budget.ag_budget.index', compact('ag_permintaans' ,'divisions', 'categories', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getPermintaan = $request->ag_permintaan_id;
        $ag_permintaans = AG_Permintaan::with(['categories', 'assets', 'divisions'])->where('id', $getPermintaan)->first();
        $categories = Category::with('ag_permintaans')->where('id', $ag_permintaans->category_id)->first();
        $assets = Asset::with('ag_permintaans')->where('id', $ag_permintaans->asset_id)->first();
        $divisions = Division::with('ag_permintaans')->where('id', $ag_permintaans->division_id)->first();
        // $companies = Company::with('ag_permintaans')->where('id', $ag_permintaans->company_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getPermintaan' => $getPermintaan,'ag_permintaans' => $ag_permintaans,  'divisions'=>$divisions, 'assets' => $assets, 'categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AG_budget $ag_budgets)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'quantity' => 'required',
            'unitPrice' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->level;
            $createdUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
            $budget_uniqueid = Helper::IDGenerator(new AG_budget, 'budget_id', 'BUDGET', 5);

            $data = new AG_budget();
            $data -> date = $getDate;
            $data -> budget_id = $budget_uniqueid;
            $data -> ag_permintaan_id = $request->input('ag_permintaan_id');
            $data -> group = $request->input('group');
            $data -> division_id = $request->input('division_id');
            $data -> category_id = $request->input('category_id');
            $data -> asset_id = $request->input('asset_id');
            $data -> quantity = $request->input('quantity');
            $data -> unitPrice = $request->input('unitPrice');
            $data -> totalPrice = $request->totalPrice;
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
        $ag_budgets = AG_budget::with(['ag_permintaans' ,'divisions', 'categories', 'assets'])->where('id', $id)->first();
        $ag_permintaans = AG_Permintaan::with('ag_budgets')->where('id', $ag_budgets->ag_permintaan_id)->first();
        $divisions = Division::with('ag_budgets')->where('id', $ag_budgets->division_id)->first();
        $categories = Category::with('ag_budgets')->where('id', $ag_budgets->category_id)->first();
        $assets = Asset::with('ag_budgets')->where('id', $ag_budgets->asset_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $ag_permintaans->date)->format('d-m-Y');
        if($ag_budgets)
        {
            return response()->json(['status' => 200, 'ag_budgets' => $ag_budgets, 'ag_permintaans' => $ag_permintaans, 'divisions' => $divisions, 'categories' => $categories, 'assets' => $assets, 'getDate' => $getDate]);
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
            // 'quantity' => 'required',
            // 'unitPrice' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $ag_budgets = AG_budget::find($id);
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($ag_budgets)
            {
                $ag_budgets -> date = $getDate;
                $ag_budgets -> ag_permintaan_id = $request->ag_permintaan_id;
                $ag_budgets -> group = $request->input('group');
                $ag_budgets -> division_id = $request->division_id;
                $ag_budgets -> category_id = $request->category_id;
                $ag_budgets -> asset_id = $request->asset_id;
                $ag_budgets -> quantity = $request->input('quantity');
                $ag_budgets -> unitPrice = $request->input('unitPrice');
                $ag_budgets -> totalPrice = $request->totalPrice;
                $ag_budgets -> description = $request->input('description');
                $ag_budgets -> updatedBy = $getBy;
                $ag_budgets -> updatedUtc = $getUtc;
                $ag_budgets -> update();
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
        $ag_budgets = AG_budget::find($id);
        if($ag_budgets)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $ag_budgets->deletedBy = $getBy;
            $ag_budgets->deletedUtc = $getUtc;
            $ag_budgets->update();

            return response()->json(['status' => 200, 'messages' => 'Data sudah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
