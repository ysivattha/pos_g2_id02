@extends('layouts.master')
@section('title')
    Stock Balance
@endsection
@section('header')
    Stock Balance
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}">
<div class="toolbox pt-1 pb-1">

    <div class="row">
    <div class="col-md-2">
        
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
            <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    {{-- @cancreate('item')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate --}}
</div>


</form>
</div>  
</div>   
<div class="card">
	
	<div class="card-body">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered" style="width: 100%" id="data_balance">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Item_Name</th>
                    <th>Qty_Begin</th>
                    <th>Qty_Add</th>
                    <th>Qty_Minus</th>
                    <th>Qty_Balance</th>
                    <th>Note</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
           
        </table>
	</div>
</div>




@endsection

@section('js')
<script>

</script>
@endsection