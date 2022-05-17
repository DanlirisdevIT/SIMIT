<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Danliris_Temperature;
Use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class Danliris_Temperature_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $danliris_temperatures = Danliris_Temperature::get();
        if($request->ajax()){
            return DataTables::of($danliris_temperatures)
            ->addIndexColumn()
            ->make(true);
        }
        
        return view('upload_data.danliris_temperature.index')->with('danliris_temperatures', $danliris_temperatures);
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
            'datafile' => 'required|mimes:xlsx,xls,pdf|max:10000',
            'document_name' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        else
        {
            $createdBy = Auth::user()->level;
            // $getDate = Carbon::parse($request->input('created_at'))->format('Y-m-d');

            $data = new Danliris_Temperature();

            if ($request->hasfile('datafile')) {           
                // $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
                $filename =$request->file('datafile')->getClientOriginalName();
                $request->file('datafile')->move(public_path('uploads/pdf'), $filename);
                 Danliris_Temperature::create(
                        [                        
                            'datafile' => $filename,
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
