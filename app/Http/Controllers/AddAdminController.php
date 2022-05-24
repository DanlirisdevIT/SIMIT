<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AddAdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('companies')->whereNull('deletedBy')->get();
        $companies = Company::all();
        if($request->ajax()){
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function($data) {
                $btn = ' <a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteAdmin"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.index', compact('companies'));
    }

    public function create(){
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json(['status'=>400, 'errors'=>$validator->errors()]);
        }
        else
        {
            $createdBy = Auth::user()->name;
            $createdUtc = Carbon::now();
            $password = $request->password;
            $company_id = $request->company_id;
            $company_name = Company::with('users')->where('id',$company_id)->first();

            $data = new User();
            $data -> name = $request->input('name');
            $data -> username = $request->input('username');
            $data -> password = bcrypt($password);
            $data -> level = 'admin';
            $data -> company_id = $company_id;
            $data -> company_name = $company_name->companyName;
            $data -> createdBy = $createdBy;
            $data -> createdUtc = $createdUtc;
            $data -> save();

            return response()->json(['status'=>200, 'messages'=>'Data berhasil ditambahkan.']);
        }
    }

    public function update($id)
    {
        $user = User::find($id);
        if($user)
        {
            // $user->delete();
            $user->deletedBy = Auth::user()->name;
            $user->deletedUtc = Carbon::now();
            $user->update();
            return response()->json([
                'status' => 200,
                'messages' => 'Data berhasil dihapus.'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'messages' => 'Data tidak ditemukan.'
            ]);
        }
    }
}
