<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Section;
use DB;
use DataTables;
use Auth;
class DepartmentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         app()->setLocale(Auth::user()->language);
    //         return $next($request);
    //     });
    // }
    public function index()
    {
        // if(!check('department', 'l')){
        //     return view('permissions.no');
        // }
        
        // if ($r->ajax()) 
        // {
        //     $data = Department::where('active', 1);
        //     return Datatables::of($data)
        //         ->addColumn('check', function($row){
        //             $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
        //             return $input;
        //         })
        //         ->addIndexColumn()
              
        //         ->addColumn('action', function($row){
        //             $btn = btn_actions($row->id, 'departments', 'department');
        //             return $btn;
        //         })
        //         ->rawColumns(['action', 'check'])
        //         ->make(true);
        // }
        return view('departments.index');
    }
    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;


     

    
        $data = $r->except('_token', 'per', 'tbl');
        $data['user_id'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
        $i = DB::table($tbl)->insert($data);
            return (int)$i;
    }
  
   
}
