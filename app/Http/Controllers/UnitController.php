<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
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
        if (request()->ajax()) 
        {
            $data = \DB::table('sto_unit')
            ->where('sto_unit.is_active',1)
            ->leftjoin('users','sto_unit.user_id','users.id')
            ->select('sto_unit.*','users.first_name as fname','users.last_name as lname')
            ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_unit', 'sto_unit');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('unit.index');
    }




}
