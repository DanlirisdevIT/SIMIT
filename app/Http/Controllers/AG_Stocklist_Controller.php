<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\AG_StocklistImport;
use Illuminate\Http\Request;
use App\Models\AG_Stocklist;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AG_Stocklist_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ag_stocklists = AG_Stocklist::all();
        if($request->ajax()){
            return Datatables::of($ag_stocklists)
            ->addIndexColumn()
            ->make(true);
        }
        return view('stock.ag_stockopname.index', ['ag_stocklists' => $ag_stocklists]);
    }

    public function import(Request $request)
    {
        Excel::import(new AG_StocklistImport, $request->file('file'));

        return back();
    }

   
}
