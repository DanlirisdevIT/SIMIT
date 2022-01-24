<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Asset;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::whereNull('deletedBy')->get();
        if($request->ajax()){
            return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" class="btn btn-primary btn-sm editCategory"><i class="far fa-edit"></i></a>';
                // $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" name="'.$data->category_name.'" type="'.$data->category_type.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.category.index', compact('categories'));
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
            'category_name' => 'required',
            'category_type' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $getBy = Auth::user()->name;
            $getUtc = Carbon::now();

            $data = new Category();
            $data -> category_name = $request->input('category_name');
            $data -> category_type = $request->input('category_type');
            $data -> createdBy = $getBy;
            $data -> createdUtc = $getUtc;
            $data -> save();

            return response()->json(['status' => 200, 'messages' => 'Data telah ditambahkan']);
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
        $categories = Category::find($id);
        if($categories)
        {
            $html =
            '
            <div class="form-group">
                <label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>
                <select class="form-control" id="category_type" name="category_type">
                    <option value='.$categories->category_type.' selected="selected"> --- '.$categories->category_type.' --- </option>
                    <option value=""></option>
                    <option value="Asset">Asset</option>
                    <option value="Consumable">Consumable</option>
                    <option value="Component">Component</option>
                    <option value="License">License</option>
                    <option value="Accesories">Accesories</option>

                </select>
            </div>

            <div class="form-group">
                <div class="addedForm"></div>
            </div>
            ';
            return response()->json(['status' => 200, 'html'=>$html, 'categories'=>$categories]);
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Tidak ada data ditemukan.']);
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
            'category_name' => 'required',
            'category_type' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        else
        {
            $categories = Category::find($id);
            if($categories)
            {
                $getBy  = Auth::user()->name;
                $getUtc = Carbon::now();

                $categories->category_name=$request->input('category_name');
                $categories->category_type=$request->input('category_type');
                $categories->updatedBy=$getBy;
                $categories->updatedUtc=$getUtc;
                $categories->update();

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
        $categories=Category::find($id);
        $assets = Asset::with('categories')->where('category_id', $categories->id)->exists();
        if($categories)
        {
            if($assets)
            {
                return response()->json(['status'=>400, 'messages'=>'Data Kategori masih digunakan.']);
            }
            else
            {
                $getBy  = Auth::user()->name;
                $getUtc = Carbon::now();

                $categories->deletedBy=$getBy;
                $categories->deletedUtc=$getUtc;
                $categories->update();

                return response()->json(['status' => 200, 'messages' => 'Data telah terhapus']);
            }
        }
        else
        {
            return response()->json(['status' => 404, 'messages' => 'Data tidak ditemukan']);
        }
    }
}
