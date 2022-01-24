<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\AG_Permintaan;
use App\Models\Asset;
use App\Models\Company;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AG_Permintaan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $permintaans = AG_Permintaan::with(['categories', 'assets', 'divisions', 'companies', 'units'])->whereNull('deletedBy')->get();
        $ag_permintaans = AG_Permintaan::with(['categories', 'assets', 'divisions', 'companies', 'units'])->whereNull('deletedBy')->get();
        $categories = Category::all();
        $assets = Asset::all();
        $divisions = Division::all();
        $companies = Company::all();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($ag_permintaans)
            ->addIndexColumn()
            ->addColumn('date', function($data) {
                $date = Carbon::createFromFormat('Y-m-d', $data->date)->format('d F Y');
                return $date;
            })
            ->addColumn('action', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editPermintaan"><i class="far fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['action', 'date'])
            ->make(true);
        }

        return view('permintaan.ag_permintaan.index', compact('units', 'categories', 'assets', 'divisions', 'companies'));
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
            'date' => 'required',
            'username' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            $data = new AG_Permintaan();
            $data -> date = $getDate;
            $data -> username = $request->input('username');
            $data -> division_id = $request->input('division_id');
            $data -> company_id = $request->input('company_id');
            $data -> category_id = $request->input('category_id');
            $data -> asset_id = $request->input('asset_id');
            $data -> unit_id = $request->input('unit_id');
            $data -> quantity = $request->input('quantity');
            $data -> description = $request->input('description');
            $data -> createdBy = $getBy;
            $data -> createdUtc = $getUtc;
            $data -> save();

            return response()->json(['status' => 200, 'messages' => 'Data telah ditambahkan']);
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
        $ag_permintaans = AG_Permintaan::with(['categories', 'assets', 'divisions', 'companies', 'units'])->where('id', $id)->first();
        $categories = Category::with('ag_permintaans')->where('id', $ag_permintaans->category_id)->first();
        $assets = Asset::with('ag_permintaans')->where('id', $ag_permintaans->asset_id)->first();
        $divisions = Division::with('ag_permintaans')->where('id', $ag_permintaans->division_id)->first();
        $companies = Company::with('ag_permintaans')->where('id', $ag_permintaans->company_id)->first();
        $units = Unit::with('ag_permintaans')->where('id', $ag_permintaans->unit_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $ag_permintaans->date)->format('d-m-Y');

        if($ag_permintaans)
        {
            return response()->json(['status' => 200, /**'html'=> $html,**/ 'ag_permintaans' => $ag_permintaans, 'getDate' => $getDate, 'divisions'=>$divisions,
                                    'companies' => $companies, 'assets' => $assets, 'categories' => $categories, 'units' => $units
                                ]);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
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
            'username' => 'required',
            'quantity' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>'400', 'errors'=>$validator->errors()]);
        }
        else
        {
            $ag_permintaans= AG_Permintaan::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($ag_permintaans)
            {
                $ag_permintaans->date= $getDate;
                $ag_permintaans->username= $request->input('username');
                $ag_permintaans->company_id= $request->company_id;
                $ag_permintaans->division_id= $request->division_id;
                $ag_permintaans->category_id= $request->category_id;
                $ag_permintaans->asset_id= $request->asset_id;
                $ag_permintaans->unit_id = $request->unit_id;
                $ag_permintaans->quantity= $request->input('quantity');
                $ag_permintaans->description= $request->input('description');
                $ag_permintaans->updatedBy=$getBy;
                $ag_permintaans->updatedUtc=$getUtc;
                $ag_permintaans->update();

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
        $ag_permintaans = AG_Permintaan::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        if($ag_permintaans)
        {
            $ag_permintaans->deletedBy = $getBy;
            $ag_permintaans->deletedUtc = $getUtc;
            $ag_permintaans->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $ag_permintaans->errors()]);
        }
    }
}
