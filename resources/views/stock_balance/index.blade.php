@extends('layouts.master')
@section('title')
    {{__('lb.items')}}
@endsection
@section('header')
    {{__('lb.items')}}
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
       <table class="table table-sm table-bordered" style="width: 100%" id="balance_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.item')}}</th>
                    <th>{{__('lb.Qty-Begin')}}</th>
                    <th>{{__('lb.Qty-Add')}}</th>
                    <th>{{__('lb.qty_minus')}}</th>
                    <th>{{__('lb.qty_balance')}}</th>
                    <th>{{__('lb.note')}}</th>
                   
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
           
        </table>
	</div>
</div>




@endsection

@section('js')
<script>
         
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // get unit
    var table = $('#balance_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('balance.index') }}",
            type: 'GET'
        },
        columns: [
            {
                data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false
            },
            {
                data: 'date',
                name: 'date'
            },
           
            {
                data: 'product_name',
                name: 'product_name'
            },
            {
                data: 'qty_begin',
                name: 'qty_begin'
            },
            {
                data: 'qty_add',
                name: 'qty_add'
            },
            {
                data: 'qty_minus',
                name: 'qty_minus'
            },
            {
                data: 'qty_balance',
                name: 'qty_balance'
            },
            {
                data: 'note',
                name: 'note'
            },
            {
                data: 'username',
                name: 'username'
            },
          
           
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    })

</script>
@endsection