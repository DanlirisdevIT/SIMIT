<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Danliris_RBT;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Upload;
use PDF;

class Danliris_RBT_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $danliris_rbts = Danliris_RBT::orderBy('datafile', 'DESC')->whereNull('document_name')->get();
        $danliris_rbts = Danliris_RBT::get();
        if($request->ajax()) {
            return DataTables::of($danliris_rbts)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-name="'.$data->datafile.'" class="btn btn-primary btn-sm previewPdf">Preview</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('upload_data.danliris_rbt.index');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {

        // $file = public_path('uploads/pdf');
        // return response()->file($file);

        // $path = "uploads/pdf";
        // $pdf = PDF::loadView('request.pdf', $data)->save(public_path($path));
        // return $pdf->stream("request.pdf");

        Route::get('/pdf/{file}', function ($file) {
            // file path
           $path = public_path('storage/file' . '/' . $file);
            // header
           $header = [
             'Content-Type' => 'uploads/pdf',
             'Content-Disposition' => 'inline; filename="' . $file . '"'
           ];
          return response()->file($path, $header);
      })->name('pdf');
    }

    public function preview($id)
    {
        // $file = File::findOrFail($id);
        // $file->increment('preview');
        // $file->update();

        // if($file->file)
        //     {
        //         $file_path = public_path('/public/'. $file->file);
        //         return response()->preview($file_path);
        //     }
        // else
        //     {
        //         $headers = [
        //             'content-Type' => 'upload/pdf',
        //         ];

        //         return response()->preview($file->link, 'testing.pdf', $headers);
        //     }
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
            // 'filename' => 'required|mimes:pdf|max:10000',
            'datafile' => 'required|mimes:pdf|max:10000',
            'document_name' => 'required',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        else
        {
            $createdBy = Auth::user()->level;

            $data = new Danliris_RBT();
            
            if ($request->hasfile('datafile')) {           
                // $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
                $filename =$request->file('datafile')->getClientOriginalName();
                $request->file('datafile')->move(public_path('uploads/pdf'), $filename);
                Danliris_RBT::create(
                        [                        
                            'datafile' =>$filename,
                            'document_name' => $request->input('document_name')
                        ]
                    );
            // $data -> datafile = $request->$filename;
            $data -> document_name = $request->input('document_name');
            $data->createdBy = $createdBy;
            // $data ->save();

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
