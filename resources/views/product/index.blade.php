@extends('layouts.master')
@section('title')
    {{__('lb.item')}}
@endsection
@section('header')
    {{__('lb.item')}}
@endsection
@section('content')  
    <div class="toolbox pt-1 pb-1">
        @cancreate('item')
        <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal'>
            <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
        </button>
        @endcancreate
        @candelete('item')
        <button class="btn btn-danger btn-sm" title="Delete selected users" id='btnDelete' 
            table='roles' permission='role' token="{{csrf_token()}}">
            <i class="fa fa-trash"></i> {{__('lb.delete')}}
        </button>
        @endcandelete
    </div>   
    <div class="card">
        <div class="card-body">
            @component('coms.alert')
            @endcomponent
            <table class="table table-sm table-bordered datatable" id='dataTable' style="width: 100%">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>
                            <input type="checkbox" onclick="check(this)" value="off">
                        </th> --}}
                       
                        <th>{{__('lb.id')}}</th>
                        <th>{{__('lb.date')}}</th>
                        {{-- <th>{{__('lb.image')}}</th> --}}
                        <th>{{__('lb.barcode')}}</th>
                        <th>{{__('lb.ref_name')}}</th>
                        <th>{{__('lb.product_name')}}</th>
                        <th>{{__('lb.category')}}</th>
                        <th>{{__('lb.cost')}}</th>
                        <th>{{__('lb.price')}}</th>
                        <th>{{__('lb.unit')}}</th>
                        <th>{{__('lb.income')}}</th>
                        <th>{{__('lb.note')}}</th>
                        <th>{{__('lb.user')}}</th>
                        <th>{{__('lb.action')}}</th>

                    </tr>
                </thead>
              
            </table>
        </div>
    </div>
          
@endsection

@section('js')

<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
	<script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#menu_stock>a").addClass("active");
            $("#menu_stock").addClass("menu-open");
            $("#menu_item").addClass("myactive");
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

			var table = $('#dataTable').DataTable({
                pageLength: 50,
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: {
                    url: "{{ route('product.index') }}",
                    type: 'GET'
                },
                columns: [
               
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'date', name: 'date'},
                    {data: 'barcode', name: 'barcode'},
                    {data: 'ref_name', name: 'ref_name'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'cat_name', name: 'category.name'},
                    {data: 'cost', name: 'cost'},
                    {data: 'price', name: 'price'},
                    {data: 'unit_name', name: 'unit.name'},
                    {data: 'income', name: 'income'},
                    {data: 'note', name: 'note'},
                    {data: 'fname', name: 'users.name'},
                    
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
        });
        // function edit(id, obj)
        // {
        //     $('#esms').html('');
        //     let tbl = $(obj).attr('table');
        //     $.ajax({
        //         type: 'GET',
        //         url: burl + '/bulk/get/' + id + '?tbl=' + tbl,
        //         success: function(sms)
        //         {
        //             let data = JSON.parse(sms);
        //             $('#eid').val(data.id);
        //             $('#ename').val(data.name);
        //         }
        //     });
        // }
    </script>
@endsection