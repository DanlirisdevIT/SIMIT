<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\Efrata_StocklistImport;
use App\Models\Efrata_Stocklist;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class Efrata_Stocklist_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_stocklists = Efrata_Stocklist::all();
        if($request->ajax()){
            return Datatables::of($efrata_stocklists)
            ->addIndexColumn()
            ->make(true);
        }
        return view('stock.efrata_stockopname.index', ['efrata_stocklists' =>$efrata_stocklists]);
    }

    public function import(Request $request)
    {
        Excel::import(new Efrata_StocklistImport, $request->file('file'));

        return back();
    }
    
}
