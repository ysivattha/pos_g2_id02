<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
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
        $data['customer'] = DB::table('cus_customer')->where('is_active', 1)->get();
        return view('dashboard', $data);
    }
    public function print() {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        $data['hospital'] = DB::table('hospitals')->where('id', $user->hospital_id)->first();
        return view('print', $data);
    }
}
