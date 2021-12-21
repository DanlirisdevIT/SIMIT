<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editSupplier"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" name="'.$data->supplier_name.'" address="'.$data->address.'"phone="'.$data->phone.'"agentName="'.$data->agent_name.'" type="'.$data->partner_type.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSupplier"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.supplier.index', compact('suppliers'));
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
            'supplier_name' => 'required',
            'address' => 'required',
            'phone' => 'required|string|min:10|max:12|regex:/[0-9]{9}/',
            'agent_name' => 'required',
            'partner_type' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();

            $data = new Supplier();
            $data -> supplier_name = $request->input('supplier_name');
            $data -> address = $request->input('address');
            $data -> phone = $request->input('phone');
            $data -> agent_name = $request->input('agent_name');
            $data -> partner_type = $request->input('partner_type');
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
        $suppliers = Supplier::find($id);
        if($suppliers)
        {
            $html =
            '
            <div class="form-group">
                <label name="supplier_name" class="col-sm-4 control-label"> Nama </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Masukkan nama supplier..." value = "'.$suppliers->supplier_name.'" maxlength="50" required>
                </div>
            </div>

            <div class="form-group">
                <label name="address" class="col-sm-4 control-label"> Alamat </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat..." value = "'.$suppliers->address.'" maxlength="50" required>
                </div>
            </div>

            <div class="form-group">
                <label name="phone" class="col-sm-4 control-label"> No Telp </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan no telp..." value = "'.$suppliers->phone.'" maxlength="50" required>
                </div>
            </div>

            <div class="form-group">
                <label name="agent_name" class="col-sm-4 control-label"> Nama Agen </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="agent_name" name="agent_name" placeholder="Masukkan nama agen..." value = "'.$suppliers->agent_name.'" maxlength="50" required>
                </div>
            </div>

            <div class="form-group">
                <label name="partner_type" class="col-sm-4 control-label"> Tipe Kategori </label>
                <select class="form-control" id="partner_type" name="partner_type">
                    <option value='.$suppliers->partner_type.' selected="selected"> --- '.$suppliers->partner_type.' --- </option>
                    <option value=""></option>
                    <option value="Partnership"> Partnership </option>
                    <option value="General Partnership"> General Partnership </option>
                    <option value="Limited Partnership"> Limited Partnership </option>
                </select>
            </div>
            ';
            return response()->json(['status' => 200, 'html'=>$html, 'suppliers'=>$suppliers]);
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
            'supplier_name' => 'required',
            'address' => 'required',
            'phone' => 'required|string|min:10|max:12|regex:/[0-9]{9}/',
            'agent_name' => 'required',
            'partner_type' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $suppliers = Supplier::find($id);
            if($suppliers)
            {
                $getBy  = Auth::user()->name;
                $getUtc = Carbon::now();

                $suppliers->supplier_name=$request->input('supplier_name');
                $suppliers->address=$request->input('address');
                $suppliers->phone=$request->input('phone');
                $suppliers->agent_name=$request->input('agent_name');
                $suppliers->partner_type=$request->input('partner_type');
                $suppliers->updatedBy=$getBy;
                $suppliers->updatedUtc=$getUtc;
                $suppliers->update();

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
        $suppliers=Supplier::find($id);
        if($suppliers)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();

            $suppliers->deletedBy=$getBy;
            $suppliers->deletedUtc=$getUtc;
            $suppliers->update();

            return response()->json(['status' => 200, 'messages' => 'Data telah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
