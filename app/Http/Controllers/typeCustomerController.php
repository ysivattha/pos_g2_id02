<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class typeCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }

    // read data
    public function index()
    {
        if (request()->ajax()) {
            $type = DB::table('cus_customer_type')
            ->join('users','cus_customer_type.user_id','users.id')
            ->select('cus_customer_type.*','users.username')
            ->get();
            return datatables()->of($type)
            ->addIndexColumn()
            ->addColumn('action', function($type) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $type->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $type->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('type-customer.index');
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;

        $data = Validator::make($r->all(), [
            'c_type' => 'required',

            

        ]);
     
        if ($data->passes()) {

                 // if(!check($per, 'i')){
        //     return 0;
        // }
    
        $data = $r->except('_token', 'per', 'tbl');
        $data['user_id'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
        $i = DB::table($tbl)->insert($data);
            return (int)$i;
        }

        return -1;
    }
    
}
