<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Manufacture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $assets = Asset::with(['manufactures', 'categories'])->whereNull('deletedBy')->get();
        $manufactures = Manufacture::all();
        $categories = Category::all();
        if($request->ajax()){
            return DataTables::of($assets)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editAsset"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" asset_name="'.$data->asset_name.'" model_number="'.$data->model_number.'" EOL="'.$data->EOL.'"  data-original-title="Delete" class="btn btn-danger btn-sm deleteAsset"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.asset.index', compact('manufactures', 'categories'));
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
        $validator = Validator::make($request->all(), [
            'asset_name'=>'required',
            // 'manufactureName'=>'required',
            // 'category_name'=>'required',
            // 'model_number'=>'required',
            // 'EOL'=>'required',
            // 'images'=>'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'notes'=>'required',
        ]);

        if($validator->fails()){
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else{

            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();

            $data = new Asset();
            $data->asset_name=$request->input('asset_name');
            $data->manufacture_id=$request->manufacture_id;
            // $data->manufactureName=$request->input('manufactureName');
            $data->category_id=$request->category_id;
            // $data->category_name=$request->input('category_name');
            $data->model_number=$request->input('model_number');
            $data->EOL=$request->input('EOL');
            if($request->hasFile('images')){
                $file = $request->file('images');
                $extension = $file->getClientOriginalName();
                $filename = date('d-m-Y').' - '.$extension;
                $file->move('uploads/images/', $filename);
                $data->images = $filename;
            }
            $data->notes=$request->input('notes');
            $data -> createdBy = $getBy;
            $data -> createdUtc = $getUtc;
            $data->save();

            return response()->json(['status'=>200, 'messages'=>'Data telah ditambahkan']);
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
        $assets = Asset::with(['manufactures', 'categories'])->where('id', $id)->first();
        // $assets = Asset::with(['manufactures' => function ($query) {
        //     $query->where('id', '=', 'manufacture_id');
        // }])->first();
        // $assets = Asset::with(['manufactures', 'categories'])->where('id', $id)->first();
        $manufactures = Manufacture::with('assets')->where('id', $assets->manufacture_id)->first();
        $manufactures2 = Manufacture::all();
        $categories = Category::with('assets')->where('id', $assets->category_id)->first();
        if($assets)
        {
            // $html =
            // '
            //     <div class="form-group">
            //         <label name="asset_name" class="col-sm-4 control-label"> Nama </label>
            //         <div class="col-sm-12">
            //             <input type="text" class="form-control" id="asset_name" name="asset_name" placeholder="Masukkan nama Asset..." value="'.$assets->asset_name.'"  maxlength="50" required>
            //         </div>
            //     </div>
            //     <div class="form-group">
            //         <label name="manufacture_id" class="col-sm-4 control-label"> Pilih Manufaktur </label>
            //         <select class="form-control" id="manufacture_id" name="manufacture_id">
            //             <option value='.$manufactures->id.' selected="selected"> --- '.$manufactures->manufactureName.' --- </option>
            //             <option value=""></option>';
            //             foreach($manufactures2 as $manufaktur):
            //                 $html .= '<option value='.$manufaktur->id.'> '.$manufaktur->manufactureName.' </option>'
            //                 ;
            //             endforeach;
            //         $html .='</select>
            //     </div>
            //     <div class="form-group">
            //         <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
            //         <select class="form-control" id="category_id" name="category_id">
            //             <option value='.$categories->id.' selected="selected"> --- '.$categories->category_type.' --- </option>
            //             <option value=""></option>
            //             <option value="Asset">Asset</option>
            //             <option value="Consumable">Consumable</option>
            //             <option value="Component">Component</option>
            //             <option value="License">License</option>
            //             <option value="Accesories">Accesories</option>
            //         </select>
            //     </div>
            //     <div class="form-group">
            //         <label name="model_number" class="col-sm-4 control-label"> Nomor Model </label>
            //         <div class="col-sm-12">
            //             <input type="text" class="form-control" id="model_number" name="model_number" placeholder="Nomor model..." value="'.$assets->model_number.'" maxlength="50" required>
            //         </div>
            //     </div>
            //     <div class="form-group">
            //         <label name="EOL" class="col-sm-4 control-label"> EOL </label>
            //         <div class="col-sm-12">
            //             <input type="number" class="form-control" id="EOL" name="EOL" placeholder="EOL..." value="'.$assets->EOL.'" maxlength="50" required>
            //         </div>
            //     </div>
            //     <div class="form-group">
            //         <label name="notes" class="col-sm-4 control-label"> Keterangan </label>
            //         <div class="col-sm-12">
            //             <textarea class="form-control" id="notes" name="notes" placeholder="Masukkan keterangan..."  maxlength="50" required>'.$assets->notes.'</textarea>
            //         </div>
            //     </div>
            //     <div class="form-group mb-3">
            //         <label name="images" class="col-sm-4 control-label"> Pilih Gambar </label>
            //         <div class="col-sm-12">
            //             <input type="file" class="form-control-file" id="update-images" name="images" > '.$assets->images.'
            //         </div>
            //         <br>
            //         <img src="" id="upload-update-img" width="100" height="100">
            //     </div>

            // ';
            // $html = '<a href="javascript:void(0)" data-toggle="tooltip" id="'.$assets->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAsset"><i class="far fa-trash-alt"></i></a>';
            return response()->json(['status' => 200, 'assets' => $assets, 'manufactures' => $manufactures, 'categories' => $categories]);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan']);
        }
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
        $validator = Validator::make($request->all(), [
            'asset_name'=>'required',
            // 'manufactureName'=>'required',
            // 'category_name'=>'required',
            // 'model_number'=>'required',
            // 'EOL'=>'required',
            // 'images'=>'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'notes'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();
            $assets = Asset::find($id);
            if($assets)
            {
                $assets->asset_name=$request->input('asset_name');
                $assets->manufacture_id=$request->manufacture_id;
                $assets->category_id=$request->category_id;
                $assets->EOL=$request->EOL;
                $assets->model_number=$request->model_number;
                $assets->notes=$request->notes;
                // $file_photo = $request->file('images');
                // if($request->hasFile('images'))
                // {   
                //     $prev_path = "uploads/images/".$assets->images;
                //     if(file_exists($prev_path))
                //     {
                //         unlink($prev_path);
                //     }
                //     $file = $request->file('images');
                //     $extension = $file->getClientOriginalName();
                //     $filename = time().'-'.$extension;
                //     $file->move('uploads/images/', $filename);
                //     $assets->images = $filename;
                // }
                if($request->hasFile('images'))
                {
                    $prev_path = "uploads/images/".$assets->images;
                    if(file_exists($prev_path))
                    {
                        unlink($prev_path);
                    }
                    $file = $request->file('images');
                    $extension = $file->getClientOriginalName();
                    $filename = time().'-'.$extension;
                    $file->move('uploads/images/', $filename);
                    $assets->images = $filename;
                }
                $assets->updatedBy=$getBy;
                $assets->updatedUtc=$getUtc;
                $assets->update();
                return response()->json(['status' => 200, 'messages' => 'Data berhasil diperbaharui.']);
            }
            else
            {
                return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assets = Asset::find($id);
        if($assets)
        {
            $getBy  = Auth::user()->name;
            $getUtc = Carbon::now();
            $prev_path = "uploads/images/".$assets->images;

            $assets->images = unlink($prev_path);
            $assets->deletedBy = $getBy;
            $assets->deletedUtc = $getUtc;
            $assets->update();

            return response()->json(['status' => 200, 'messages' => 'Data sudah terhapus']);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
