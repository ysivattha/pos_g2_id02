<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use DB;
use DataTables;
use Auth;


class PositionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         app()->setLocale(Auth::user()->language);
    //         return $next($request);
    //     });
    // }
    public function index(Request $r)
    {
        // if(!check('position', 'l')){
        //     return view('permissions.no');
        // }
        
        // if ($r->ajax()) 
        // {
        //     $data = Position::where('active', 1)->orderBy('id', 'desc');
        //     return Datatables::of($data)
        //         ->addColumn('check', function($row){
        //             $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
        //             return $input;
        //         })
        //         ->addIndexColumn()
        //         ->addColumn('action', function($row){
        //             $btn = btn_actions($row->id, 'positions', 'position');
        //             return $btn;
        //         })
        //         ->rawColumns(['action', 'check'])
        //         ->make(true);
        // }
        return view('positions.index');
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;


     
      

                 // if(!check($per, 'i')){
        //     return 0;
        // }
    
        $data = $r->except('_token', 'per', 'tbl');
        $data['user_id'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
        $i = DB::table($tbl)->insert($data);
        
        if($i)
        {
            return (int)$i;
        }else
        {
            return -1;
        }
        
        

    
    }
}
