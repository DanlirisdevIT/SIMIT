<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Efrata_Ups;
use Illuminate\Support\Facades\Validator;

class Efrata_Ups_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $efrata_ups = Efrata_Ups::orderBy('datafile', 'DESC')->get();
        return view('upload_data.efrata_ups.index')->with('efrata_ups', $efrata_ups);
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
            'filename' => 'required|mimes:pdf|max:10000',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->hasfile('filename')) {           
            $filename =$request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path('uploads/pdf'), $filename);
             Efrata_Ups::create(
                    [                        
                        'datafile' =>$filename
                    ]
                );
            return back()->with('success', 'File berhasil diupload!');
        }
        
        
        else{
            return back()->with('error', 'Jenis file tidak didukung');
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
