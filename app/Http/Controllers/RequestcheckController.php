<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requestcheck;
use DB;
use DataTables;
use Auth;
class RequestcheckController extends Controller
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
        if(!check('request', 'l')){
            return view('permissions.no');
        }
        
        if($r->start_date!= null && $r->end_date!= null && $r->keyword ==null) {
            $data['start_date'] = $r->start_date;
            $data['end_date'] = $r->end_date;
            $data['keyword'] = $r->keyword;
            $data['requests'] = DB::table('requestchecks')
                ->where('requestchecks.date', '>=', $r->start_date)
                ->where('requestchecks.date', '<=', $r->end_date)
                ->where('requestchecks.active', 1)
                ->orderBy('requestchecks.id', 'desc')
                ->paginate(1000);
        }
        if($r->start_date== null && $r->end_date!= null && $r->keyword == null) {
            $data['start_date'] = $r->start_date;
            $data['end_date'] = $r->end_date;
            $data['keyword'] = $r->keyword;
            $data['requests'] = DB::table('requestchecks')
                ->join('customers', 'customers.id', 'requestchecks.patient_id')
                ->select('requestchecks.*', 'customers.code as pcode', 'customers.kh_first_name as kh_first_name', 'customers.kh_last_name as kh_last_name')
                ->where('requestchecks.date', '<=', $r->end_date)
                ->orderBy('requestchecks.id', 'desc')
                ->where('requestchecks.active', 1)
                ->paginate(1000);
        } if($r->start_date== null && $r->end_date!=null && $r->keyword !=null)  {
        
            $data['start_date'] = $r->start_date;
            $data['end_date'] = $r->end_date;
            $data['keyword'] = $r->keyword;
            $keyword1 = $r->keyword;
            $data['requests'] = DB::table('requestchecks')
            >leftJoin('customers', 'requestchecks.patient_id', 'customers.id')
            ->select('requestchecks.*')
            ->where(function($query) use ($keyword1){
                $tkeyword = trim($keyword1);
                $query
                    ->orWhere('requestchecks.code', 'like', "%{$tkeyword}%")
                    ->orWhere('hospital_reference', 'like', "%{$tkeyword}%")
                    ->orWhere('customers.code', 'like', "%{$tkeyword}%")
                    ->orWhere('customers.phone', 'like', "%{$tkeyword}%")
                    ->orWhere('customers.kh_first_name', 'like', "%{$tkeyword}%")
                    ->orWhere('customers.kh_last_name', 'like', "%{$tkeyword}%")
                    ->orWhere('hospital', 'like', "%{$tkeyword}%");
            })
            ->where('date', '>=', $r->start_date)
            ->where('date', '<=', $r->end_date)
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(1000);
        } 
        if($r->end_date!=null && $r->start_date !=null && $r->keyword != null)  {
            $data['start_date'] = $r->start_date;
            $data['end_date'] = $r->end_date;
            $data['keyword'] = $r->keyword;
            $keyword1 = $r->keyword;
            $data['requests'] = DB::table('requestchecks')
                ->leftJoin('customers', 'requestchecks.patient_id', 'customers.id')
                ->select('requestchecks.*')
                ->where(function($query) use ($keyword1){
                    $tkeyword = trim($keyword1);
                    $query
                        ->orWhere('requestchecks.code', 'like', "%{$tkeyword}%")
                        ->orWhere('hospital_reference', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.code', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.phone', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.kh_first_name', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.kh_last_name', 'like', "%{$tkeyword}%")
                        ->orWhere('hospital', 'like', "%{$tkeyword}%");
                })
                ->where('requestchecks.date', '>=', $r->start_date)
                ->where('requestchecks.date', '<=', $r->end_date)
                ->orderBy('requestchecks.id', 'desc')
                ->where('requestchecks.active', 1)
                ->paginate(1000);
        } 
        if($r->end_date==null && $r->end_date ==null && $r->keyword != null)  {
            $data['start_date'] = $r->start_date;
            $data['end_date'] = $r->end_date;
            $data['keyword'] = $r->keyword;
            $keyword1 = $r->keyword;
            $data['requests'] = DB::table('requestchecks')
                ->leftJoin('customers', 'requestchecks.patient_id', 'customers.id')
                ->select('requestchecks.*')
                ->where(function($query) use ($keyword1){
                    $tkeyword = trim($keyword1);
                    $query
                        ->orWhere('requestchecks.code', 'like', "%{$tkeyword}%")
                        ->orWhere('hospital_reference', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.code', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.phone', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.kh_first_name', 'like', "%{$tkeyword}%")
                        ->orWhere('customers.kh_last_name', 'like', "%{$tkeyword}%")
                        ->orWhere('hospital', 'like', "%{$tkeyword}%");
                })
            ->where('date', '>=', $r->start_date)
            ->where('date', '<=', $r->end_date)
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(1000);
        } 
        if($r->start_date== null && $r->end_date == null && $r->keyword == null){
            $data['start_date'] = "";
            $data['keyword'] = "";
            $data['end_date'] = "";
            $data['requests'] = DB::table('requestchecks')
                ->where('active', 1)
                ->orderBy('id', 'desc')
                ->paginate(config('app.row'));

                return view('requests.index', $data);
        }
        return view('requests.index',$data);
    }
    public function send_technical($id) {
        if(!check('request', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'request_status' => 5,
            'updated_at' => date('Y-m-d H:i'),
            'updated_by' => Auth::user()->id,
        ); 
        $request_detail = DB::table('request_details')
            ->where('id', $id)
            ->first();
        $request = DB::table('requestchecks')
            ->where('id', $request_detail->request_id)
            ->first();
        $i = DB::table('request_details')
            ->where('id', $id)
            ->update($data);
        if($i) {
            return redirect('request/detail/'.$request->id)
            ->with('success', config('app.success'));
        } else {
            return redirect('request/detail/'.$request->id)
            ->with('error', config('app.error'));
        }
    }
    public function send_doctor($id) {
        if(!check('front_office', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'request_status' => 8,
            'updated_at' => date('Y-m-d H:i'),
            'time_translate' => date('Y-m-d H:i'),
            'updated_by' => Auth::user()->id,
        ); 
        $request_detail = DB::table('request_details')
            ->where('id', $id)
            ->first();
        $request = DB::table('requestchecks')
            ->where('id', $request_detail->request_id)
            ->first();
        $i = DB::table('request_details')
            ->where('id', $id)
            ->update($data);
        if($i) {
            return redirect('request/detail/'.$request->id)
            ->with('success', config('app.success'));
        } else {
            return redirect('request/detail/'.$request->id)
            ->with('error', config('app.error'));
        }
       
    }
    public function today(Request $r) {
        if(!check('request', 'l')){
            return view('permissions.no');
        }
        $data['start_date'] = date('Y-m-d');
        $data['end_date'] = date('Y-m-d');
        $data['keyword'] = $r->keyword;
        $today = date('Y-m-d');
            $data['requests'] =  DB::table('requestchecks')
            ->where('active', 1)
            ->where('date', $today)
            ->orderBy('id', 'desc')
            ->paginate(config('app.row'));

            return view('requests.dyw', $data);
            
    }

    public function yesterday(Request $r) {
        if(!check('request', 'l')){
            return view('permissions.no');
        }
        $data['start_date'] = date('Y-m-d');
        $data['end_date'] = date('Y-m-d');
        $yesterday =  date('Y-m-d',strtotime("-1 days"));
        $data['keyword'] = $r->keyword;
        $data['requests'] =  DB::table('requestchecks')
        ->where('active', 1)
        ->where('date', $yesterday)
        ->orderBy('id', 'desc')
        ->paginate(config('app.row'));
            return view('requests.dyw', $data);
    }

    public function week(Request $r) {
        if(!check('request', 'l')){
            return view('permissions.no');
        }
        $data['start_date'] = date('Y-m-d');
        $data['end_date'] = date('Y-m-d');
        $week =  date('Y-m-d',strtotime("-7 days"));
        $week2 =  date('Y-m-d',strtotime("-14 days"));
        $data['keyword'] = $r->keyword;
        $data['requests'] =  DB::table('requestchecks')
        ->where('active', 1)
        ->where('date', '>=', $week)
        ->where('date', '<=', $week2)
        ->orderBy('id', 'desc')
        ->paginate(config('app.row'));
            return view('requests.dyw', $data);
    }
    public function detail_update(Request $r) {
        if(!check('request', 'u')){
            return view('permissions.no');
        }
        $data = array(
            'patient_id' => $r->patient_id,
            'date' => $r->date,
            'time' => $r->time,
            'symptom' => $r->symptom,
            'hospital' => $r->hospital,
            'hospital_reference' => $r->hospital_reference,
            'hospital_id' => $r->hospital_id,
        );
        $i = DB::table('requestchecks')->where('id', $r->request_id)->update($data);
        if($i) {
            return redirect()->route('request.detail', $r->request_id)
            ->with('success', config('app.success'))
            ->withInput();

        } else {
            return redirect()->route('request.detail', $r->request_id)
            ->with('error', config('app.error'))
            ->withInput();
        }
    }
    public function detail($id)
    {
        if(!check('request', 'l')){
            return view('permissions.no');
        }
        $data['hospitals'] = DB::table('hospitals')
            ->where('active',1)
            ->get();
        $data['patients'] = DB::table('customers')
            ->where('active', 1)
            ->get();
        $data['request'] = DB::table('requestchecks')
            ->join('customers', 'customers.id', 'requestchecks.patient_id')
            ->select('requestchecks.*', 'customers.id as pid', 'customers.kh_first_name as pfirst_name', 'customers.kh_last_name as plast_name', 'customers.phone')
            ->where('requestchecks.id', $id)
            ->first();
        $data['request_details'] = DB::table('request_details')
            ->leftJoin('users', 'users.id', 'request_details.percent1')
            ->select('users.first_name as dfirst_name', 'users.last_name as dlast_name', 'users.phone', 'request_details.*')
            ->where('request_details.request_id', $id)
            ->where('request_details.active', 1)
            ->orderBy('request_details.id', 'desc')
            ->get();

        $data['doctors'] = DB::table('users')
            ->where('active', 1)
            ->get();
        $data['sections'] = DB::table('sections')
            ->where('active', 1)
            ->get();
        $data['items'] = DB::table('items')
            ->where('active', 1)
            ->get();
        return view('requests.detail', $data);
    }

    public function save_detail(Request $r) {
        if(!check('request', 'u')){
            return view('permissions.no');
        }
        $item = DB::table('items')->where('id', $r->item_id)->first();
        $section = DB::table('sections')->where('id', $r->section_id)->first();
        $data = array(
                'request_id' => $r->request_id,
                'date' => $r->request_date,
                'time' => $r->request_time,
                'section_id' => $r->section_id,
                'section_name' => $section->name,
                'request_note' => $r->request_note,
                'item_id' => $r->item_id,
                'item_name' => $item->name,
                'behind_of' => $r->behind_of,
                'price' => $r->price,
                'discount' => $r->discount,
                'percent1' => $r->percent1,
                'request_status' => 1,
                'created_by' => Auth::user()->id
        );
        $i = DB::table('request_details')->where('request_id', $r->id)->insertGetId($data);
        
        if($i) {
            return redirect()->route('request.detail', $r->request_id)
            ->with('success', config('app.success'))
            ->withInput();

        } else {
            return redirect()->route('request.detail', $r->request_id)
            ->with('error', config('app.error'))
            ->withInput();
        }
      
    }
    public function create(Request $r)
    {
        if(!check('request', 'i')){
            return view('permissions.no');
        }
        $data['patient_id'] = $r->query('patient_id');
        $data['patients'] = DB::table('customers')
            ->where('active', 1)
            ->get();
        $data['doctors'] = DB::table('users')
            ->where('active', 1)
            ->get();
        $data['sections'] = DB::table('sections')
            ->where('active', 1)
            ->get();
        $data['items'] = DB::table('items')
            ->where('active', 1)
            ->get();
        $data['hospitals'] = DB::table('hospitals')
            ->where('active',1)
            ->get();
        return view('requests.create', $data);
    }
    public function store(Request $r)
    {
        if(!check('request', 'i')){
            return view('permissions.no');
        }
        $data = array(
            'patient_id' => $r->patient_id,
            'date' => $r->date,
            'time' => $r->time,
            'symptom' => $r->symptom,
            'hospital' => $r->hospital,
            'hospital_reference' => $r->hospital_reference,
            'hospital_id' => $r->hospital_id,
            'created_by' => Auth::user()->id
        );
        
        if( $r->item_id) {
            $i = DB::table('requestchecks')->insertGetId($data);
            if($i)
            {
                $code = "R" . sprintf('%04d', $i);
                    DB::table('requestchecks')
                    ->where('id', $i)
                    ->update([
                        'code' => $code
                    ]);
                $items = $r->item_id;
                $j = 0; 
                if($items == null) {
                    return redirect()->route('request.create')
                        ->with('error', config('app.error'))
                        ->withInput();
                } else {
                    foreach($items as $item) {
                        $data2= array(
                        'request_id' => $i,
                        'date' => $r->request_date[$j],
                        'time' => $r->request_time[$j],
                        'section_id' => $r->section_id[$j],
                        'request_note' => $r->request_note[$j],
                        'behind_of' => $r->behind_of[$j],
                        'section_name' => $r->section_name[$j],
                        'item_id' => $r->item_id[$j],
                        'item_name' => $r->item_name[$j],
                        'price' => $r->price[$j],
                        'discount' => $r->discount[$j],
                        'percent1' => $r->percent1[$j],
                        'request_status' => 1,
                        'created_by' => Auth::user()->id
                        );
            
                        DB::table('request_details')->insert($data2);
                        
                        $j++;
                    }
                    return redirect()->route('request.detail', $i)
                        ->with('success', config('app.success'))
                        ->withInput();
                }
            }
        }
        else{
            return redirect()->route('request.create')
                ->with('error', config('app.error'))
                ->withInput();
        }
    }
    public function delete($id)
    {
        if(!check('request', 'd')){
            return view('permissions.no');
        }
        DB::table('requestchecks')
            ->where('id', $id)
            
            ->update(['active'=>0,'updated_by'=>Auth::user()->id,'updated_at'=>date('Y-m-d H:i')] );
        
            return redirect()->route('request.index')
            ->with('success', config('app.success'))
            ->withInput();
    }
    public function delete_detail($id, Request $r) {
        if(!check('request', 'd')){
            return view('permissions.no');
        }
        $i = DB::table('request_details')
            ->where('id', $id)
            ->update(['active'=>0,'updated_by'=>Auth::user()->id,'updated_at'=>date('Y-m-d H:i')] );
            
      
        if($i) {
            return redirect('request/detail/'.$r->query('request_id'))
                ->with('success', config('app.success'))
                ->withInput();
        } else {
    
            return redirect('request/detail/'.$r->query('request_id'))
            ->with('error', config('app.error'))
            ->withInput();
        }
    
    }

    public function update(Request $r) {
        if(!check('front_office', 'u')){
            return view('permissions.no');
        }
        $section = DB::table('sections')
            ->where('id', $r->section_id)
            ->first();
        $item = DB::table('items')
            ->where('id', $r->item_id)
            ->first();
        $item = DB::table('items')->where('id', $r->item_id)->first();
        $section = DB::table('sections')->where('id', $r->section_id)->first();

       $request_detail = DB::table('request_details')->where('id', $r->id)->first();

        $data = array(
                'date' => $r->request_date,
                'time' => $r->request_time,
                'section_id' => $r->section_id,
                'section_name' => $section->name,
                'request_note' => $r->request_note,
                'item_id' => $r->item_id,
                'item_name' => $item->name,
                'price' => $r->price,
                'discount' => $r->discount,
                'percent1' => $r->percent1,
                'behind_of' => $r->behind_of,
                'updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i'),
        );

        $i = DB::table('request_details')->where('id', $r->id)->update($data);
        
        if($i) {
            return redirect('request/detail/'.$r->request_id)
            ->with('success', config('app.success'))
            ->withInput();

        } else {
            return redirect('request/detail/'.$r->request_id)
            ->with('error', config('app.error'))
            ->withInput();
        }
    }
    public function get_request_detail($id)
    {
        $data = DB::table('request_details')
            ->where('active', 1)
            ->find($id);
        return json_encode($data);
    }

}
