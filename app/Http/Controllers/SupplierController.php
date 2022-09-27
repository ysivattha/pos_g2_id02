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
          $supplier = DB::table('supplier')
          ->join('users','supplier.user_id','users.id')
          ->join('supplier_type','supplier.type_id','supplier_type.id')
          ->select('supplier.*','supplier_type.s_type','users.username')
          ->get();
            return datatables()->of($supplier)
            ->addIndexColumn()
            ->addColumn('action', function($supplier) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $supplier->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $supplier->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('supplier.index');
    }
}
