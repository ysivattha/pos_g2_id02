<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StockAdjustController extends Controller
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

            $data = \DB::table('sto_stock_adjust')
            ->join('sto_item','sto_stock_adjust.item_id','sto_item.id')
            ->join('users','sto_stock_adjust.user_id','users.id')
            ->select('sto_stock_adjust.*','sto_item.product_name','users.username')
            ->where('sto_stock_adjust.is_active',1)
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

            return view('stockadjust.index');
    }
}
