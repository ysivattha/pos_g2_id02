<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SupplierController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
        
    }
    public function index()
    {
        if (request()->ajax()) {
          $supplier = DB::table('sup_supplier')
          ->leftjoin('users','sup_supplier.user_id','users.id')
          ->leftjoin('sup_supplier_type','sup_supplier.type_id','sup_supplier_type.id')
          ->select('sup_supplier.*','sup_supplier_type.s_type','users.username')
          ->get();
            return datatables()->of($supplier)
            ->addIndexColumn()
            ->addColumn('action', function($supplier) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $supplier->id .')"><i class="fa fa-edit"></i> Edit</a>' 
                . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $supplier->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }

        $data['sup_type']= \DB::table('sup_supplier_type')
        ->where('is_active',1)->get();
        
        return view('supplier.index',$data);
    }

    public function store(Request $r)
    {
        $tbl = $r->tbl;
        $per = $r->per;
        $data = $r->except('_token', 'per', 'tbl',);
        
      

   
        $data['user_id'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
       
        $i = \DB::table($tbl)->insert($data);
        //return (int)$i;
    }
}
