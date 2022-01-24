<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Efrata_Permintaan;
use App\Models\Asset;
use App\Models\Company;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Efrata_Permintaan_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $permintaans = efrata_Permintaan::with(['categories', 'assets', 'divisions', 'companies', 'units'])->whereNull('deletedBy')->get();
        $efrata_permintaans = Efrata_Permintaan::with(['categories', 'assets', 'divisions', 'companies', 'units'])->whereNull('deletedBy')->get();
        $categories = Category::all();
        $assets = Asset::all();
        $divisions = Division::all();
        $companies = Company::all();
        $units = Unit::all();
        if($request->ajax()){
            return DataTables::of($efrata_permintaans)
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

        return view('permintaan.efrata_permintaan.index', compact('units', 'categories', 'assets', 'divisions', 'companies'));
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

            $data = new Efrata_Permintaan();
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
        $efrata_permintaans = Efrata_Permintaan::with(['categories', 'assets', 'divisions', 'companies', 'units'])->where('id', $id)->first();
        $categories = Category::with('efrata_permintaans')->where('id', $efrata_permintaans->category_id)->first();
        $assets = Asset::with('efrata_permintaans')->where('id', $efrata_permintaans->asset_id)->first();
        $divisions = Division::with('efrata_permintaans')->where('id', $efrata_permintaans->division_id)->first();
        $companies = Company::with('efrata_permintaans')->where('id', $efrata_permintaans->company_id)->first();
        $units = Unit::with('efrata_permintaans')->where('id', $efrata_permintaans->unit_id)->first();
        $getDate = Carbon::createFromFormat('Y-m-d', $efrata_permintaans->date)->format('d-m-Y');

        if($efrata_permintaans)
        {
            return response()->json(['status' => 200, /**'html'=> $html,**/ 'efrata_permintaans' => $efrata_permintaans, 'getDate' => $getDate, 'divisions'=>$divisions,
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
            $efrata_permintaans= Efrata_Permintaan::find($id);
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');

            if($efrata_permintaans)
            {
                $efrata_permintaans->date= $getDate;
                $efrata_permintaans->username= $request->input('username');
                $efrata_permintaans->company_id= $request->company_id;
                $efrata_permintaans->division_id= $request->division_id;
                $efrata_permintaans->category_id= $request->category_id;
                $efrata_permintaans->asset_id= $request->asset_id;
                $efrata_permintaans->unit_id = $request->unit_id;
                $efrata_permintaans->quantity= $request->input('quantity');
                $efrata_permintaans->description= $request->input('description');
                $efrata_permintaans->updatedBy=$getBy;
                $efrata_permintaans->updatedUtc=$getUtc;
                $efrata_permintaans->update();

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
        $efrata_permintaans = Efrata_Permintaan::find($id);
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        if($efrata_permintaans)
        {
            $efrata_permintaans->deletedBy = $getBy;
            $efrata_permintaans->deletedUtc = $getUtc;
            $efrata_permintaans->update();

            return response()->json(['status' => 200, 'messages' => 'data berhasil dihapus']);
        }
        else
        {
            return response()->json(['status' => 400, 'messages' => $efrata_permintaans->errors()]);
        }
    }
}
