<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = \DB::table('sto_item')
        // ->join('sto_category' , 'sto_item.category','sto_category.id')
        // ->join('users','sto_item.user','users.id')
        // ->join('acc_income_type','sto_item.income_type_id','acc_income_type.id')
        // ->join('sto_unit','sto_item.unit','sto_unit.id')
        
        // ->select('sto_item.*','sto_category.category as cat_name','users.first_name as fname','acc_income_type.in_type as income','sto_unit.unit as unit_name')
        // ->get();
        // dd($data);
        // if(!check('user', 'l')){
        //     return view('permissions.no');
        // }
        if (request()->ajax()) 
        {

            $data = \DB::table('sto_item')

            ->leftjoin('sto_category' , 'sto_item.category','sto_category.id')
            ->leftjoin('users','sto_item.user','users.id')
            ->leftjoin('acc_income_type','sto_item.income_type_id','acc_income_type.id')
            ->leftjoin('sto_unit','sto_item.unit','sto_unit.id')
            

            // ->join('sto_category' , 'sto_item.category_id','sto_category.id')
            // ->join('users','sto_item.user_id','users.id')
            // ->join('acc_income_type','sto_item.income_type_id','acc_income_type.id')
            // ->join('sto_unit','sto_item.unit_id','sto_unit.id')

            ->select('sto_item.*','sto_category.category as cat_name','users.first_name as fname','acc_income_type.in_type as income','sto_unit.unit as unit_name')
            ->get();
            return datatables()->of($data)
                // ->addColumn('check', function($row){
                //     $input = "<input type='checkbox' id='ch{$row->id}' value='{$row->id}'>";
                //     return $input;
                // })
                // ->addColumn('photo', function($row){
                //     $url = asset($row->photo);
                //     $img = "<img src='{$url}' width='27'>";
                //     return $img;
                // })

                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = btn_actions($row->id, 'sto_item', 'sto_item');
                    return $btn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
