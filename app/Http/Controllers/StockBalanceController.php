<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class StockBalanceController extends Controller
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

            $data = DB::table('sto_stock_balance')
            ->leftjoin('users','sto_stock_balance.user_id','users.id')
            ->leftjoin('sto_item','sto_stock_balance.item_id','sto_item.id')
            ->select('sto_stock_balance.*','users.username','sto_item.product_name','sto_item.barcode')
            ->where('sto_stock_balance.is_active',1)
            ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_item', 'sto_item');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('stock_balance.index');
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;

        $data = Validator::make($r->all(), [
            'item_id' => 'required',

            

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
