<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Efrata_budget;
use App\Models\Division;
use App\Models\Efrata_Permintaan;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EfrataBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $budgets = Budget::with(['permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        $efrata_budgets = Efrata_budget::with(['efrata_permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        // $permintaans = Permintaan::all();
        $efrata_permintaans = Efrata_Permintaan::all();
        $divisions = Division::all();
        $categories = Category::all();
        $assets = Asset::all();
        if($request->ajax()){
            return DataTables::of($efrata_budgets)
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
        return view('budget.efrata_budget.index', compact('efrata_permintaans' ,'divisions', 'categories', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getPermintaan = $request->efrata_permintaan_id;
        $efrata_permintaans = Efrata_Permintaan::with(['categories', 'assets', 'divisions'])->where('id', $getPermintaan)->first();
        $categories = Category::with('efrata_permintaans')->where('id', $efrata_permintaans->category_id)->first();
        $assets = Asset::with('efrata_permintaans')->where('id', $efrata_permintaans->asset_id)->first();
        $divisions = Division::with('efrata_permintaans')->where('id', $efrata_permintaans->division_id)->first();
        // $companies = Company::with('efrata_permintaans')->where('id', $efrata_permintaans->company_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getPermintaan' => $getPermintaan,'efrata_permintaans' => $efrata_permintaans,  'divisions'=>$divisions, 'assets' => $assets, 'categories' => $categories ]);
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
            $budget_uniqueid = Helper::IDGenerator(new Efrata_budget, 'budget_id', 'BUDGET', 5);

            $data = new Efrata_budget();
            $data -> date = $getDate;
            $data -> budget_id = $budget_uniqueid;
            $data -> efrata_permintaan_id = $request->input('efrata_permintaan_id');
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
     * @param  \App\Models\Efrata_budget  $efrata_budget
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Efrata_budget  $efrata_budget
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $efrata_budgets = Efrata_budget::with(['efrata_permintaans' ,'divisions', 'categories', 'assets'])->where('id', $id)->first();
        $efrata_permintaans = Efrata_Permintaan::with('efrata_budgets')->where('id', $efrata_budgets->efrata_permintaan_id)->first();
        $divisions = Division::with('efrata_budgets')->where('id', $efrata_budgets->division_id)->first();
        $categories = Category::with('efrata_budgets')->where('id', $efrata_budgets->category_id)->first();
        $assets = Asset::with('efrata_budgets')->where('id', $efrata_budgets->asset_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $efrata_permintaans->date)->format('d-m-Y');
        if($efrata_budgets)
        {
            return response()->json(['status' => 200, 'efrata_budgets' => $efrata_budgets, 'efrata_permintaans' => $efrata_permintaans, 'divisions' => $divisions, 'categories' => $categories, 'assets' => $assets, 'getDate' => $getDate]);
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
     * @param  \App\Models\Efrata_budget  $efrata_budget
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
            $efrata_budgets = Efrata_budget::find($id);
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($efrata_budgets)
            {
                $efrata_budgets -> date = $getDate;
                $efrata_budgets -> efrata_permintaan_id = $request->efrata_permintaan_id;
                $efrata_budgets -> group = $request->input('group');
                $efrata_budgets -> division_id = $request->division_id;
                $efrata_budgets -> category_id = $request->category_id;
                $efrata_budgets -> asset_id = $request->asset_id;
                $efrata_budgets -> quantity = $request->input('quantity');
                $efrata_budgets -> unitPrice = $request->input('unitPrice');
                $efrata_budgets -> totalPrice = $request->totalPrice;
                $efrata_budgets -> description = $request->input('description');
                $efrata_budgets -> updatedBy = $getBy;
                $efrata_budgets -> updatedUtc = $getUtc;
                $efrata_budgets -> update();
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
     * @param  \App\Models\Efrata_budget  $efrata_budget
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $efrata_budgets = Efrata_budget::find($id);
        if($efrata_budgets)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $efrata_budgets->deletedBy = $getBy;
            $efrata_budgets->deletedUtc = $getUtc;
            $efrata_budgets->update();

            return response()->json(['status' => 200, 'messages' => 'Data sudah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
