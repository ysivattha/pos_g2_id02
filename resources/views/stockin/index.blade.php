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
{{-- 
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button> --}}
</div>


</form>
</div>  
</div>   
<div class="card">
	
	<div class="card-body">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered" style="width: 100%" id="DataTable">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.supplier')}}</th>
                    <th>{{__('lb.amount')}}</th>
                    <th>{{__('lb.discount')}}</th>
                    <th>{{__('lb.total')}}</th>
                    <th>{{__('lb.tax')}}</th>
                    <th>{{__('lb.total_with_tax')}}</th>
                    <th>{{__('lb.seller')}}</th>
                   
                    <th>{{__('lb.paid')}}</th>
                    <th>{{__('lb.rest')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.username')}}</th>
                    <th>{{ __('lb.action') }}</th>
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
        $("#menu_stock").addClass('menu-open');
        $("#item").addClass('active');
        $("#stock_in").addClass('myactive');

        $(".chosen-select").chosen({width: "100%"});
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#DataTable').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('stockin.index') }}",
            type: 'GET'
        },
        
        columns: [
            {
                data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false
            },
            {
                data: 'contact_name',
                name: 'contact_name'
            },
            {
                data: 'amount',
                name: 'amount'
            },
            {
                data: 'discount',
                name: 'discount'
            },
            {
                data: 'total',
                name: 'total'
            },
            {
                data: 'tax',
                name: 'tax'
            },
            {
                data: 'total_with_tax',
                name: 'total_with_tax'
            },
            {
                data: 'seller_id',
                name: 'seller_id'
            },

            {
                data: 'paid',
                name: 'paid'
            },
            {
                data: 'rest',
                name: 'rest'
            },
            {
                data: 'note',
                name: 'note'
            },
            {
                data: 'fname',
                name: 'fname'
            },
           
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    });

    // $("#create_from").on('submit', function(e){
    //      e.preventDefault();
   
      
    //     var data = $(evt.target).serialize();
     
    //     $.ajax({
       
    //       data: {
    //         data
    //       //  _token: "{{ csrf_token() }}"
    //         },
    //       url: "{{ route('stockin.store') }}",
    //       type: "POST",
    //       dataType: 'json',
    //       success: function(sms){
    //         console.log(sms);
    //         // if(sms>0)
    //         // {
    //         //     let txt = `<div class='alert alert-success p-2' role='alert'>
    //         //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //         //             <span aria-hidden='true'>&times;</span>
    //         //         </button>
    //         //         <div>
    //         //             Data has been saved successfully!
    //         //         </div>
    //         //     </div>`;
    //         //     //$('#sms').html(txt);
    //         //     $("#create_form").trigger('reset');
    //         //     $('#stock_in_table').DataTable().ajax.reload();
    //         //     // update all chosen select
    //         //   // $('#create_form .chosen-select').trigger("chosen:updated");
    //         // }
    //         // else{
    //         //     let txt = `<div class='alert alert-danger p-2' role='alert'>
    //         //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //         //             <span aria-hidden='true'>&times;</span>
    //         //         </button>
    //         //         <div>
    //         //             Fail to save data, please check again!
    //         //         </div>
    //         //     </div>
    //         //     `;
    //         //     //$('#sms').html(txt);
    //         // }
            
    //     }
    //   });

    // }


    });

    $("#create_form").submit(function(e) {
    e.preventDefault(); // prevent actual form submit
    var form = $(this);
    var url = form.attr('action'); //get submit url [replace url here if desired]
    $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes form input
         success: function(sms){
           
            if(sms>0)
            {
                let txt = `<div class='alert alert-success p-2' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <div>
                        Data has been saved successfully!
                    </div>
                </div>`;
                $('#sms').html(txt);
                $("#create_form")[0].reset();
                $('#stock_in_table').DataTable().ajax.reload();
                // update all chosen select
                $('#create_form .chosen-select').trigger("chosen:updated");
                setTimeout(function() { 
                    $('#createModal').modal('hide');
                    $('#sms').html("");
                }, 500);
       
            }
            else{
                let txt = `<div class='alert alert-danger p-2' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <div>
                        Fail to save data, please check again!
                    </div>
                </div>
                `;
                $('#sms').html(txt);
            }
        }
    });
});
         

</script>

<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
	<script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#menu_stock>a").addClass("active");
            $("#menu_stock").addClass("menu-open");
            $("#menu_stockin").addClass("myactive");
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
                    url: "{{ route('stockin.index') }}",
                    type: 'GET'
                },
                columns: [
               
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'supplier', name: 'date'},
                    {data: 'amount', name: 'barcode'},
                    
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
    </script>
@endsection