<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Auth::user()->language);
            return $next($request);
        });
    }
    public function index(Request $r)
    {
        if(!check('item', 'l')){
            return view('permissions.no');
        }
        $data['item'] = DB::table('sto_item')
        ->join('sections','item.id','sections.id')
        ->select('sto_item.*', 'sections.name as sname')
        ->get();
        return view('items.index',$data);
    
        if($r->section==null){
            $data['section'] = '';
        $data['item'] = Item::LeftJoin('sections', 'sections.id', 'items.section_id')
                ->where('items.active', 1)
                ->orderBy('items.id', 'desc')
                ->select('items.*', 'sections.name as sname')
                ->paginate(config('app.row'));
    }else {
        $data['section'] = $r->section;
            $data['items'] = Item::LeftJoin('sections', 'sections.id', 'items.section_id')
            ->where('items.active', 1)
            ->orderBy('items.id', 'desc')
            ->where('section_id', $r->section)
            ->select('items.*', 'sections.name as sname')
            ->paginate(config('app.row'));
        }
            
}
}
