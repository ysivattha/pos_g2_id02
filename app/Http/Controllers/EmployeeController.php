<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    //

    public function Index()
    {
        return view('employee.index');
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
