<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $divisions = Division::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($divisions)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editDivision"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" name="'.$data->division_name.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDivision"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.division.index');
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
            'division_name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->level;
            $createdUtc = Carbon::now();

            $data = new Division();
            $data -> division_name = $request->input('division_name');
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

             return response()->json(['status'=>200, 'messages'=>'Data berhasil ditambahkan.']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $divisions = Division::find($id);
        if($divisions)
        {
            $html =
            '<div class="form-group">
                <label name="division_name" class="col-sm-4 control-label"> Nama </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="division_name" name="division_name" placeholder="Masukkan nama lokasi..." value = "'.$divisions->division_name.'"  maxlength="50" required>
                </div>
            </div>';

            return response()->json(['status' => 200, 'html' => $html, 'divisions'=>$divisions]);
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
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'division_name' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $divisions = Division::find($id);
            if($divisions)
            {
                $getBy  = Auth::user()->name;
                $getUtc = Carbon::now();

                $divisions -> division_name = $request->input('division_name');
                $divisions -> updatedBy = $getBy;
                $divisions -> updatedUtc = $getUtc;
                $divisions -> update();
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
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisions = Division::find($id);
        $units =  Unit::with('divisions')->where('division_id', $divisions->id)->exists();
        if($divisions)
        {
            // if($units)
            // {
            //     return response()->json(['status'=>400, 'messages'=>'Data Divisi masih digunakan.']);
            // }
            // else
            // {
            try
            {
                $divisions->deletedBy = Auth::user()->name;
                $divisions->deletedUtc = Carbon::now();
                $divisions->update();
                return response()->json([
                    'status' => 200,
                    'messages' => 'Data berhasil dihapus.'
                ]);
            }
            catch (\Illuminate\Database\QueryException $e) {
                if ($e->getCode() == 23000)
                {
                    //SQLSTATE[23000]: Integrity constraint violation
                    abort('Resource cannot be deleted due to existence of related resources.');
                }
            }
            // }
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
