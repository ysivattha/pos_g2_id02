<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeAttachController extends Controller
{
    //

    public function index()
    {

        return view('type-attach.index');
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
        $i = \DB::table($tbl)->insert($data);
            return (int)$i;
        

    }
}
