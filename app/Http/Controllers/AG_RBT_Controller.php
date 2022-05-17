<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AG_RBT;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class AG_RBT_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ag_rbts = AG_RBT::get();
        if($request->ajax()){
            return DataTables::of($ag_rbts)
            ->addIndexColumn()
            ->make(true);
        }
        return view('upload_data.ag_rbt.index')->with('ag_rbts', $ag_rbts);
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
        $validator = Validator::make($request->all(),[
            'datafile' => 'required|mimes:pdf|max:10000',
            'document_name' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        else
        {
            $createdBy = Auth::user()->level;

            $data = new AG_RBT();

            if ($request->hasfile('datafile')) {           
                // $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
                $filename =$request->file('datafile')->getClientOriginalName();
                $request->file('datafile')->move(public_path('uploads/pdf'), $filename);
                 AG_RBT::create(
                        [                        
                            'datafile' =>$filename,
                            'document_name' => $request->input('document_name')
                        ]
                    );

            $data -> document_name = $request->input('document_name');
            $data->createdBy = $createdBy;

                return back()->with('success', 'File berhasil diupload!');
            }
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
