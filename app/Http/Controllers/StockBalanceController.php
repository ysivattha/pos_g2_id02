<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        if (request()->ajax()) {
            $balance = DB::table('stock_balance')
            ->join('users','stock_balance.user_id','users.id')
            ->join('item','stock_balance.item_id','item.id')
            ->select('stock_balance.*','users.username','item.product_name','item.barcode')
            ->get();
            return datatables()->of($balance)
            ->addIndexColumn()
            ->addColumn('action', function($balance) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $balance->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $balance->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('stock_balance.index');
    }
}
