<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }

    // read data
    public function index()
    {
        if (request()->ajax()) {
            $cate = DB::table('category')
            ->join('users','category.user_id','users.id')
            ->select('category.*','users.username')
            ->get();
            return datatables()->of($cate)
            ->addIndexColumn()
            ->addColumn('action', function($cate) {
                return '<a class="btn btn-primary btn-xs rounded-0 text-white" 
                onclick="editData('. $cate->id .')"><i class="fa fa-edit"></i> Edit</a>' . 
                ' <a class="btn btn-danger btn-xs rounded-0 text-white" 
                onclick="deleteData('. $cate->id .')"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        return view('category.index');
    }
  

   
}
