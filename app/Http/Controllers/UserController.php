<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
 
        if (request()->ajax()) 
        {
            $data = \DB::table('users')
            ->where('users.is_active',1)
            ->leftjoin('roles','users.role_id','roles.id') 
            ->select('users.*', 'users.first_name as fname', 'users.last_name as lname', 'users.last_name as lname', 'roles.name as rname')
            ->get();


            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'users', 'users');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('user.index');
    }

    
}
