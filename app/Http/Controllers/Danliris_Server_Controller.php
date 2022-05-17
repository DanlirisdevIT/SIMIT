<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Danliris_Server;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class Danliris_Server_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $danliris_servers = Danliris_Server::get();
        if($request->ajax()){
            return DataTables::of($danliris_servers)
            ->addIndexColumn()
            ->make(true);
        }
        return view('upload_data.danliris_server.index')->with('danliris_servers', $danliris_servers);
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
            'document_name' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        else
        {
            $createdBy = Auth::user()->level;

            $data = new Danliris_Server();

            if ($request->hasfile('datafile')) {           
                $filename =$request->file('datafile')->getClientOriginalName();
                $request->file('datafile')->move(public_path('uploads/pdf'), $filename);
                 Danliris_Server::create(
                        [                        
                            'datafile' => $filename,
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
