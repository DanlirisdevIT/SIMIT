<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Division;
use App\Models\Company;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units = Unit::with(['divisions', 'companies', 'locations'])->whereNull('deletedBy')->get();
        $divisions = Division::whereNull('deletedBy')->get();
        $companies = Company::whereNull('deletedBy')->get();
        $locations = Location::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($units)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editUnit"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" unit_name="'.$data->unit_name.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUnit"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.unit.index', compact('divisions', 'companies', 'locations'));
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
            'unit_name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->level;
            $createdUtc = Carbon::now();

            $data = new Unit();
            $data -> unit_name = $request->input('unit_name');
            $data->division_id = $request->division_id;
            $data->company_id = $request->company_id;
            $data->location_id = $request->location_id;
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

             return response()->json(['status'=>200, 'messages'=>'Data berhasil ditambahkan.']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Unit::with(['divisions', 'companies', 'locations'])->where('id', $id)->first();
        $divisions = Division::with('units')->where('id', $units->division_id)->first();
        $divisions2 = Division::whereNull('deletedBy')->get();
        $companies = Company::with('units')->where('id', $units->company_id)->first();
        $locations = Location::with('units')->where('id', $units->location_id)->first();
        if($units)
        {
            return response()->json(['status' => 200, 'units' => $units, 'divisions' => $divisions, 'companies' => $companies, 'locations' => $locations]);
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
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'unit_name'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $units = Unit::find($id);
            if($units)
            {
                $units->unit_name=$request->input('unit_name');
                $units->division_id=$request->division_id;
                $units->company_id=$request->company_id;
                $units->location_id=$request->location_id;
                $units->updatedBy=$getBy;
                $units->updatedUtc=$getUtc;
                $units->update();
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
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $units = Unit::find($id);
        if($units)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $units->deletedBy = $getBy;
            $units->deletedUtc = $getUtc;
            $units->update();

            return response()->json(['status' => 200, 'messages' => 'Data sudah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
