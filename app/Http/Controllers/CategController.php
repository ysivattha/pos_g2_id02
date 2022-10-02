<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategController extends Controller
{
    //

    public function index()
    {
 
        if (request()->ajax()) 
        {
            $data = \DB::table('sto_category')
            ->where('sto_category.is_active',1)
            ->leftjoin('users','sto_category.user_id','users.id')
            ->select('sto_category.*','users.first_name as fname','users.last_name as lname')
            ->get();


            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_category', 'sto_category');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('Categ.index');
    }

    public function store(Request $r)
    {
        $per = $r->per;
        $tbl = $r->tbl;
  
        $data = Validator::make($r->all(), [
            'category' => 'required',

            

        ]);
     
        if ($data->passes()) {

                 // if(!check($per, 'i')){
        //     return 0;
        // }
    
        $data = $r->except('_token', 'per', 'tbl');
        $data['user_id'] = Auth::user()->id;
        $data['is_active'] = 1;
        $data['datetime']=now();
        $i = \DB::table($tbl)->insert($data);
            return (int)$i;
        }

        return -1;
    }
}
