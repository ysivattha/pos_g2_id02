<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            $type = DB::table('type_customer')
            ->join('users','type_customer.user_id','users.id')
            ->select('type_customer.*','users.username')
            ->get();
            return datatables()->of($type)
            ->addIndexColumn()
            ->addColumn('action', function($type) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $type->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $type->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('type-customer.index');
    }
    
}
