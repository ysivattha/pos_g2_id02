<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use DataTables;

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
    public function profile()
    {
        $id = Auth::user()->id;
        $data['user'] = DB::table("users")
            ->leftjoin('roles', 'users.role_id', 'roles.id')
            ->where('users.id', $id)
            ->select('users.*', 'roles.name as rname')
            ->first();
        return view("user.profile", $data);
    }
    public function save_profile(Request $r)
    {
        $id = Auth::user()->id;
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'email' => $r->email,
            'gender' => $r->gender,
            'phone' => $r->phone,
        );
        if($r->password)
        {
            $data['password'] = bcrypt($r->password);
        }
        if($r->photo)
        {
            $data['photo'] = $r->file('photo')->store('uploads/users', 'custom');
        }
        $i = DB::table('users')
            ->where('id', $id)
            ->update($data);
        if($i)
        {
            return redirect()->route('user.profile')
                ->with('success', config('app.success'));
        }
        else{
            return redirect()->route('user.profile')
                ->with('error', config('app.error'));
        }
    }
    //change language
    public function change_lang($id)
    {
        $uid = Auth::user()->id;
        DB::table('users')
            ->where('id', $uid)
            ->update([
                'language' => $id
            ]);
        return redirect()->back();
    }
    // user sign out
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    
}
