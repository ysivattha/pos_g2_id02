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
    @cancreate('item')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate
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
    $(document).ready(function () {
        $("#menu_stock").addClass('menu-open');
        $("#menu_stock").addClass('active');
        $("#menu_stockbalance").addClass('myactive');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        var table = $('#data_balance').DataTable({
            pageLength: 50,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: {
                url: "{{ route('stock_balance.index') }}",
                type: 'GET'
            },
            columns: [
           
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                {data: 'date', name: 'date'},
                {data: 'product_name', name: 'sto_item.product_name'},
                {data: 'qty_begin', name: 'qty_begin'},
                {data: 'qty_add', name: 'qty_add'},
                {data: 'qty_minus', name: 'qty_minus'},
                {data: 'qty_balance', name: 'qty_balance'},
                {data: 'note', name: 'note'},
                {data: 'username', name: 'users.username'},
             
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
                "initComplete" : function () {
                    $('.dataTables_scrollBody thead tr').addClass('hidden');
                }
                    
            });
    

</script>
@endsection