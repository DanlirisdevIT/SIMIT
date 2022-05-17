<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Efrata_Change_Pc_User;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class Efrata_Change_Pc_User_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $efrata_change_pc_users = Efrata_Change_Pc_User::get();
        if($request->ajax()){
            return DataTables::of($efrata_change_pc_users)
            ->addIndexColumn()
            ->make(true);
        }
        return view('upload_data.efrata_change_pc_user.index')->with('efrata_change_pc_users', $efrata_change_pc_users);
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
            'datafile' => 'required|mimes:pdf, xls, xlsx|max:10000',
            'document_name' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        else
        {
            $createdBy = Auth::user()->level;
            
            $data = new Efrata_Change_Pc_User();

            if ($request->hasfile('datafile')) {           
                $filename =$request->file('datafile')->getClientOriginalName();
                $request->file('datafile')->move(public_path('uploads/pdf'), $filename);
                 Efrata_Change_Pc_User::create(
                        [                        
                            'datafile' =>$filename,
                            'document_name' => $request->input('document_name')
                        ]
                    );
                $data -> document_name = $request->input('document_name');
                $data -> createdBy = $createdBy;
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
