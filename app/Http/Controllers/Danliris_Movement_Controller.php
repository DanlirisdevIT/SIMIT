<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Danliris_Pemasukan;
use App\Models\Danliris_budget;
use App\Models\Danliris_Permintaan;
use App\Models\Danliris_Movement;
use App\Models\Manufacture;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Asset;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Helper;

class Danliris_Movement_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $getBy = Auth::user()->name;
        $getUtc = Carbon::now();
        $getDate = Carbon::parse($request->input('date'))->format('Y-m-d');
        $date = $getDate;
        $pemasukan_type = $request->input('pemasukan_type');
        $danliris_permintaan_id = $request->danliris_permintaan_id;
        $danliris_budget_id = $request->danliris_budget_id;
        $supplier_id = $request->supplier_id;
        $manufacture_id = $request->manufacture_id;
        $category_type = $request->category_type;
        $category_name = $request->category_name;
        $unit_id = $request->unit_id;
        $replacement_by = $request->replacement_by;
        $quantity = $request->quantity;
        $createdBy = $getBy;
        $createdUtc = $getUtc;

        $asset_id = Danliris_Budget::where(fn($query) => $query->where('id', '=', $danliris_budget_id))->pluck('asset_id');
        $asset_name = $request->asset_name;
        $quantity = $request->quantity;
        $user = Auth::user()->id;

        if($request->pemasukan_type == 'to user')
        {
            $status = 'In';
        }
        else if($request->pemasukan_type == 'to it stock' || $request->pemasukan_type == 'replacement')
        {
            $status = 'In IT';
        }

        // for($i=1; $i<=$quantity; $i++)
        // {
        //     $data_pengeluaran = [
        //         'asset_id' = $asset_id,
        //         'asset_name' = $asset_name,
        //         'quantity' = $quantity,
        //         // 'barcode' = $barcode;
        //         // $data->danliris_permintaan_id = $danliris_permintaan_id;
        //         'user_id' = $user,
        //     ];
        // }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
