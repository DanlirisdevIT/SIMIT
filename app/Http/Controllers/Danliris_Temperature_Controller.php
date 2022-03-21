<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Danliris_Temperature;
Use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Danliris_Temperature_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danliris_temperatures = Danliris_Temperature::orderBy('datafile', 'DESC')->get();
        
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
            'filename' => 'required|mimes:xlsx,xls,pdf|max:10000',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        if ($request->hasfile('filename')) {           
            // $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
            $filename =$request->file('filename')->getClientOriginalName();
            $request->file('filename')->move(public_path('uploads/pdf'), $filename);
            $getDate = Carbon::parse($request->input('created_at'))->format('Y-m-d');
             Danliris_Temperature::create(
                    [                        
                        'datafile' => $filename,
                        'created_at' => $getDate
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
