<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class StockOutController extends Controller
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
            $stock = DB::table('sto_stock_out')
            ->join('users','sto_stock_out.user','users.id')
            ->join('cus_customer','sto_stock_out.customer_id','customer.id')
            ->select('sto_stock_out.*','cus_customer.contact_name','users.username')
            ->get();
            return datatables()->of($stock)
            ->addIndexColumn()
            ->addColumn('action', function($stock) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" onclick="editData('. $stock->id .')"><i class="fa fa-edit"></i> Edit</a>' . ' <a class="btn btn-danger btn-xs rounded-0 text-white" onclick="deleteData('. $stock->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }


        $data['emps']=DB::table('hr_employee')
        ->where('is_active',1)->get();

        $data['customers']=DB::table('cus_customer')
        ->where('is_active',1)->get();

        $data['exchanges']=DB::table('sto_exchange')->get();
        
        return view('stockout.index',$data);
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;

        $data = Validator::make($r->all(), [
            'date'=>'required',
            'customer'=>'required',
            'amount' => 'required',
            'discount' => 'required',
            'total' => 'required',
            'tax'=>'required',
            'total_with_tax'=>'required',
            'seller'=>'required',
            'paid'=>'required',
            'exchange_rate'=>'required',
            'amount_khr'=>'required'
            

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
