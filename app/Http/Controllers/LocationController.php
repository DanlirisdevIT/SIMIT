<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = Location::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($locations)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editLocation"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" name="'.$data->location_name.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteLocation"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.location.index');
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
            'location_name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->level;
            $createdUtc = Carbon::now();

            $data = new Location();
            $data -> location_name = $request->input('location_name');
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

             return response()->json(['status'=>200, 'messages'=>'Data berhasil ditambahkan.']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locations = Location::find($id);
        if($locations)
        {
            $html =
            '<div class="form-group">
                <label name="location_name" class="col-sm-4 control-label"> Nama </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Masukkan nama lokasi..." value = "'.$locations->location_name.'"  maxlength="50" required>
                </div>
            </div>';

            return response()->json(['status' => 200, 'html' => $html, 'locations'=>$locations]);
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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'location_name' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $locations = Location::find($id);
            if($locations)
            {
                $getBy  = Auth::user()->name;
                $getUtc = Carbon::now();

                $locations -> location_name = $request->input('location_name');
                $locations -> updatedBy = $getBy;
                $locations -> updatedUtc = $getUtc;
                $locations -> update();
                return response()->json(['status' => 200, 'messages' => 'Data berhasil diperbaharui']);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'messages' => 'Tidak ada data ditemukan',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locations = Location::find($id);
        $units =  Unit::with('locations')->where('location_id', $locations->id)->exists();
        if($locations)
        {
            if($units)
            {
                return response()->json(['status'=>400, 'messages'=>'Data Lokasi masih digunakan di menu Unit']);
            }
            else
            {
                $locations->deletedBy = Auth::user()->name;
                $locations->deletedUtc = Carbon::now();
                $locations->update();
                return response()->json([
                    'status' => 200,
                    'messages' => 'Data berhasil dihapus.'
                ]);
            }
        }
        else
        {
            return response()->json([
                'status' => 404,
                'messages' => 'Data tidak ditemukan.'
            ]);
        }
    }
}
