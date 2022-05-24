<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Danliris_budget;
use App\Models\Unit;
use App\Models\Division;
use App\Models\Danliris_Permintaan;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DanlirisBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $budgets = Budget::with(['permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        $danliris_budgets = Danliris_budget::with(['danliris_permintaans', 'divisions', 'categories', 'assets'])->whereNull('deletedBy')->get();
        // $permintaans = Permintaan::all();
        $danliris_permintaans = Danliris_Permintaan::all();
        $filter_dl_budgets = Danliris_budget::with(['danliris_permintaans', 'divisions', 'categories', 'assets'])->whereBetween('date', array($request->from_date, $request->to_date))->whereNull('deletedBy')->get();
        $units = Unit::all();
        $divisions = Division::all();
        $categories = Category::all();
        $assets = Asset::all();
        // $user = Auth::user()->username;
        // if($request->ajax())
        // {
            if(!empty($request->from_date))
            {
                if($request->ajax())
                {
                    return DataTables::of($filter_dl_budgets)
                    ->addIndexColumn()
                    ->addColumn('danliris_permintaans.username', function($data)
                    {
                        if($data->danliris_permintaan_id = null)
                        {
                            $user = Auth::user()->username;
                            return $user;
                        }
                        else
                        {
                            return $data->danliris_permintaan_id;
                        }
                    })
                    ->addColumn('totalqty', function($data)
                    {
                        if($data->totalqty = null)
                        {
                            $val = 0;
                            return $val;
                        }
                        else
                        {
                            return $data->totalqty;
                        }
                    })
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
            }
            else
            {
                if($request->ajax())
                {
                    return DataTables::of($danliris_budgets)
                    ->addIndexColumn()
                    ->addColumn('danliris_permintaans.username', function($data)
                    {
                        if($data->danliris_permintaan_id = null)
                        {
                            $user = Auth::user()->username;
                            return $user;
                        }
                        else
                        {
                            return $data->danliris_permintaan_id;
                        }
                    })
                    ->addColumn('totalqty', function($data)
                    {
                        if($data->totalqty = null)
                        {
                            $val = 0;
                            return $val;
                        }
                        else
                        {
                            return $data->totalqty;
                        }
                    })
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
            }
        // }
        return view('budget.danliris_budget.index', compact('danliris_permintaans' ,'divisions', 'categories', 'assets', 'units'));
    }

    public function getDanliris_Permintaan()
    {
        $danliris_permintaan_all = Danliris_Permintaan::whereNull('deletedBy')->get();
        
        return response()->json(['status' => 200, 'danliris_permintaan_all' => $danliris_permintaan_all]);
    }

    public function getOrder_detail()
    {
        $order_assets = Asset::whereNull('deletedBy')->get();
        $order_units = Unit::whereNull('deletedBy')->get();
        $order_divisions = Division::whereNull('deletedBy')->get();
        $order_categories = Category::whereNull('deletedBy')->get();

        return response()->json(['status' => 200, 'order_assets' => $order_assets, 'order_units' => $order_units, 
                                'order_divisions' => $order_divisions, 'order_categories' => $order_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $getPermintaan = $request->danliris_permintaan_id;
        // $danliris_permintaan_all = Danliris_Permintaan::whereNull('deletedBy')->get();
        $danliris_permintaans = Danliris_Permintaan::with(['categories', 'assets', 'divisions', 'units'])->where('id', $getPermintaan)->first();
        $categories = Category::with('danliris_permintaans')->where('id', $danliris_permintaans->category_id)->first();
        $assets = Asset::with('danliris_permintaans')->where('id', $danliris_permintaans->asset_id)->first();
        $units = Unit::with('danliris_permintaans')->where('id', $danliris_permintaans->unit_id)->first();
        $divisions = Division::with('danliris_permintaans')->where('id', $danliris_permintaans->division_id)->first();
        // $companies = Company::with('danliris_permintaans')->where('id', $danliris_permintaans->company_id)->first();

        return response()->json(['status' => 200, /**'html'=> $html,**/ 'getPermintaan' => $getPermintaan,'danliris_permintaans' => $danliris_permintaans,  'divisions'=>$divisions, 'assets' => $assets, 'categories' => $categories, 'units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Danliris_budget $danliris_budgets)
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
            $budget_uniqueid = Helper::IDGenerator(new Danliris_budget, 'budget_id', 'BUDGET', 5);

            $data = new Danliris_budget();
            $data -> date = $getDate;
            $data -> budget_id = $budget_uniqueid;
            $data -> danliris_permintaan_id = $request->input('danliris_permintaan_id');
            $data -> group = $request->input('group');
            $data -> unit_id = $request->input('unit_id');
            $data -> division_id = $request->input('division_id');
            $data -> category_id = $request->input('category_id');
            $data -> asset_id = $request->input('asset_id');
            $data -> quantity = $request->input('quantity');
            $data -> totalqty = $request->input('totalqty');
            $data -> remind = $request->input('remind');
            $data -> unitPrice = $request->input('unitPrice');
            $data -> totalPrice = $request->totalPrice;
            $data -> description = $request->input('description');
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

            // $data = new

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
        $danliris_budgets = Danliris_budget::with(['danliris_permintaans' ,'divisions', 'categories', 'assets', 'units'])->where('id', $id)->first();
        $danliris_permintaans = Danliris_Permintaan::with('danliris_budgets')->where('id', $danliris_budgets->danliris_permintaan_id)->first();
        $divisions = Division::with('danliris_budgets')->where('id', $danliris_budgets->division_id)->first();
        $units = Unit::with('danliris_budgets')->where('id', $danliris_budgets->unit_id)->first();
        $categories = Category::with('danliris_budgets')->where('id', $danliris_budgets->category_id)->first();
        $assets = Asset::with('danliris_budgets')->where('id', $danliris_budgets->asset_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $danliris_permintaans->date)->format('d-m-Y');
        if($danliris_budgets)
        {
            return response()->json(['status' => 200, 'danliris_budgets' => $danliris_budgets, 'danliris_permintaans' => $danliris_permintaans, 'divisions' => $divisions, 'categories' => $categories, 'assets' => $assets, 'getDate' => $getDate, 'units' => $units]);
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
            $danliris_budgets = Danliris_budget::find($id);
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($danliris_budgets)
            {
                $danliris_budgets -> date = $getDate;
                $danliris_budgets -> danliris_permintaan_id = $request->danliris_permintaan_id;
                $danliris_budgets -> group = $request->input('group');
                $danliris_budgets -> division_id = $request->division_id;
                $danliris_budgets -> category_id = $request->category_id;
                $danliris_budgets -> asset_id = $request->asset_id;
                $danliris_budgets -> quantity = $request->input('quantity');
                $danliris_budgets -> unitPrice = $request->input('unitPrice');
                $danliris_budgets -> totalPrice = $request->totalPrice;
                $danliris_budgets -> description = $request->input('description');
                $danliris_budgets -> updatedBy = $getBy;
                $danliris_budgets -> updatedUtc = $getUtc;
                $danliris_budgets -> update();
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
        $danliris_budgets = Danliris_budget::find($id);
        if($danliris_budgets)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $danliris_budgets->deletedBy = $getBy;
            $danliris_budgets->deletedUtc = $getUtc;
            $danliris_budgets->update();

            return response()->json(['status' => 200, 'messages' => 'Data sudah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
