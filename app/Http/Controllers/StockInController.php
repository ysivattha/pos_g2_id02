<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class StockInController extends Controller
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
            $data = \DB::table('sto_stock_in')
            ->leftjoin('users' , 'sto_stock_in.user','users.id')
            ->select('sto_stock_in.*','users.username as uname')
            ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_stock_in', 'sto_stock_in');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['emps']=\DB::table('hr_employee')
        ->where('is_active',1)->get();

        $data['suppliers']= \DB::table('sup_supplier')
        ->where('is_active',1)->get();
      
        return view('stockin.index' , $data );
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;

        $data = Validator::make($r->all(), [
            'supplier' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'tax'=>'required',
            'total_with_tax'=>'required',
            'seller'=>'required',
            'paid'=>'required',
            

        ]);
     
        if ($data->passes()) {

                 // if(!check($per, 'i')){
        //     return 0;
        // }
    
        $data = $r->except('_token', 'per', 'tbl');
        $data['user'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
        $i = DB::table($tbl)->insert($data);
            return (int)$i;
        }

        return -1;

     
        // if(!check($per, 'i')){
        //     return 0;
        // }
    
        // $data = $r->except('_token', 'per', 'tbl');
        // $data['user_id'] = Auth::user()->id;
        // $data['datetime']=now();
        // $i = DB::table($tbl)->insert($data);
        //  return (int)$i;
    }
}
