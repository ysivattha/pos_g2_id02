<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdjustController extends Controller
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
           $adjust = DB::table('stock_adjust')
           ->join('item','stock_adjust.item_id','item.id')
           ->join('users','stock_adjust.user_id','users.id')
           ->select('stock_adjust.*','users.username','item.barcode','item.product_name')
           ->get();
            return datatables()->of($adjust)
            ->addIndexColumn()
            ->addColumn('action', function($adjust) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $adjust->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $adjust->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }

        $data['items']= \DB::table('sto_item')
        ->where('is_active',1)->get();
        
        return view('stockadjust.index',$data);
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
        $data['user'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
        $i = DB::table($tbl)->insert($data);
            return (int)$i;
        }

        return -1;
    }
}
