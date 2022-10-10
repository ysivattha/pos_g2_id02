@extends('layouts.master')
@section('title')
    Customers
@endsection
@section('header')
    Customers
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
       <table class="table table-sm table-bordered" style="width: 100%" id="customer_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.company_name')}}</th>
                    <th>{{__('lb.contact_name')}}</th>
                    <th>{{__('lb.phone')}}</th>
                    <th>{{__('lb.type')}}</th>
                    <th>{{__('lb.address')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{ __('lb.user') }}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
          
        </table>
	</div>
</div>




@endsection

@section('js')
<script>
    $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#menu_customer>a").addClass("active");
            $("#menu_customer").addClass("menu-open");
            $("#menu_sub_customer").addClass("myactive");
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

            var table = $('#customer_table').DataTable({
                pageLength: 50,
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: {
                    url: "{{ route('customer.index') }}",
                    type: 'GET'
                },
                columns: [
            
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'date', name: 'date'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'contact_name', name: 'contact_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'c_type', name: 'cus_customer.c_type'},
                    {data: 'address', name: 'address'},
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
    });
    // end

    $.ajax({
         type: "POST",
         url: "{{route('cus.store')}}",
         
         data: formData, // serializes form input
         cache:false,
        contentType: false,
        processData: false,
         success: function(sms){
           console.log(sms);
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
                $('#customer_table').DataTable().ajax.reload();
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

</script>
@endsection