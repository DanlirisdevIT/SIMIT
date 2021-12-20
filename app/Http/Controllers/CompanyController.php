<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Unit;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = Company::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($companies)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editCompany"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" name="'.$data->companyName.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCompany"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.company.index', compact('companies'));
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
            'companyName' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $data = new Company();
            $data -> companyName = $request->input('companyName');
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
        $companies = Company::find($id);
        if($companies)
        {
            $html =
            '<div class="form-group">
                <label name="companyName" class="col-sm-4 control-label"> Nama </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Masukkan nama perusahaan..." value = "'.$companies->companyName.'"  maxlength="50" required>
                </div>
            </div>';

            return response()->json(['status' => 200, 'html' => $html, 'companies'=>$companies]);
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
            'companyName' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $companies = Company::find($id);
            if($companies)
            {
                $getBy  = Auth::user()->name;
                $getUtc = Carbon::now();

                $companies -> companyName = $request->input('companyName');
                $companies -> updatedBy = $getBy;
                $companies -> updatedUtc = $getUtc;
                $companies -> update();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = Company::find($id);
        $units = Unit::with('companies')->where('company_id', $companies->id)->exists();
        if($companies)
        {
            if($units)
            {
                return response()->json(['status'=>400, 'messages'=>'Data Perusahaan masih digunakan di menu Unit']);
            }
            else
            {
                $companies->deletedBy = Auth::user()->name;
                $companies->deletedUtc = Carbon::now();
                $companies->update();
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
