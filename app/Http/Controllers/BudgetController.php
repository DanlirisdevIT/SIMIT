<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Budget;
use App\Models\Division;
use App\Models\Permintaan;
use App\Helpers\Helper;
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
        return view('budget.index', compact('permintaans' ,'divisions', 'categories', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getPermintaan = $request->permintaan_id;
        $permintaans = Permintaan::with(['categories', 'assets', 'divisions'])->where('id', $getPermintaan)->first();
        $categories = Category::with('permintaans')->where('id', $permintaans->category_id)->first();
        $assets = Asset::with('permintaans')->where('id', $permintaans->asset_id)->first();
        $divisions = Division::with('permintaans')->where('id', $permintaans->division_id)->first();
        // $companies = Company::with('permintaans')->where('id', $permintaans->company_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getPermintaan' => $getPermintaan,'permintaans' => $permintaans,  'divisions'=>$divisions, 'assets' => $assets, 'categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Budget $budgets)
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
            $budget_uniqueid = Helper::IDGenerator(new Budget, 'budget_id', 'BUDGET', 5);

            $data = new Budget();
            $data -> date = $getDate;
            $data -> budget_id = $budget_uniqueid;
            $data -> permintaan_id = $request->input('permintaan_id');
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
        $budgets = Budget::with(['permintaans' ,'divisions', 'categories', 'assets'])->where('id', $id)->first();
        $permintaans = Permintaan::with('budgets')->where('id', $budgets->permintaan_id)->first();
        $divisions = Division::with('budgets')->where('id', $budgets->division_id)->first();
        $categories = Category::with('budgets')->where('id', $budgets->category_id)->first();
        $assets = Asset::with('budgets')->where('id', $budgets->asset_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $permintaans->date)->format('d-m-Y');
        if($budgets)
        {
            return response()->json(['status' => 200, 'budgets' => $budgets, 'permintaans' => $permintaans, 'divisions' => $divisions, 'categories' => $categories, 'assets' => $assets, 'getDate' => $getDate]);
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
            $budgets = Budget::find($id);
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($budgets)
            {
                $budgets -> date = $getDate;
                $budgets -> permintaan_id = $request->permintaan_id;
                $budgets -> group = $request->input('group');
                $budgets -> division_id = $request->division_id;
                $budgets -> category_id = $request->category_id;
                $budgets -> asset_id = $request->asset_id;
                $budgets -> quantity = $request->input('quantity');
                $budgets -> unitPrice = $request->input('unitPrice');
                $budgets -> totalPrice = $request->totalPrice;
                $budgets -> description = $request->input('description');
                $budgets -> updatedBy = $getBy;
                $budgets -> updatedUtc = $getUtc;
                $budgets -> update();
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
