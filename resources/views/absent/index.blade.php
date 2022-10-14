@extends('layouts.master')
@section('title')
   {{__('absent')}}
@endsection
@section('header')
   {{__('absent')}}
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
                    
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.employee')}}</th>
                    <th>{{__('lb.absent_date')}}</th>
                    <th>{{__('lb.absent_type')}}</th>
                    <th>{{__('lb.reason')}}</th>
                    <th>{{__('lb.approved_name')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.username')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
        </table>
        

	</div>

    
</div>

@section('modal')
    <div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
        <form method="POST" id='create_form'  action="{{ route('absent.store') }}" >
            @csrf

            <input type="hidden" name="tbl" value="hr_absent">
            <input type="hidden" name="per" value="hr_absent">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <strong class="modal-title">{{ __('absent') }}</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div id="sms">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-2">

                                <label for="date">
                                    {{__('lb.date')}} <span class="text-danger">*</span>
                                </label>

                                <input type="date" name="date" id="date" class="form-control input-xs" required>
                    
                            </div>




                                    <div class="form-group mb-2">

                                            <label  for="employee_id">
                                                {{__('lb.employee')}}  <span class="text-danger">*</span>
                                            </label>


                                            <select name="employee_id" id="employee_id" class="chosen-select" required>
                                                <option value="">{{__('lb.select_one')}}</option>
                                               
                                                @foreach ($emps as $emp)
                                                <option  value="{{ $emp->id }}">{{ $emp->name_kh }}--{{ $emp->name_en }}</option>
                                                @endforeach
                                            </select>
            

                                    </div>

                                    <div class="form-group mb-2">

                                        <label for="absent_date">
                                            {{__('lb.absent_date')}} <span class="text-danger">*</span>
                                        </label>
        
                                        <input type="date" name="absent_date" id="absent_date" class="form-control input-xs" required>
                            
                                    </div>

                                    
                                    <div class="form-group mb-2">

                                        <label  for="absent_type_id">
                                            {{__('lb.absent_type')}}  <span class="text-danger">*</span>
                                        </label>


                                        <select name="absent_type_id" id="absent_type_id" class="chosen-select" required>
                                            <option value="">{{__('lb.select_one')}}</option>
                                            @foreach ($absentT as $ab)
                                            <option  value="{{ $ab->id }}">{{ $ab->absent_type_name }}</option>
                                            @endforeach
                                        </select>
        

                                </div>
        

                                    




                        </div>

                        <div class="col-sm-6">


                            <div class="form-group mb-2">

                                <label  for="reason">
                                    {{__('lb.reason')}} 
                                </label>


                                    <input type="text"  name="reason" id="reason" class="form-control input-xs" s>


                            </div>

                            <div class="form-group mb-2">

                                <label  for="approved_name_id">
                                    {{__('lb.approved_name')}}  <span class="text-danger">*</span>
                                </label>

                                <select name="approved_name_id" id="approved_name_id" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    <option value="1">123</option>
                                    {{-- @foreach ($emps as $emp)
                                    <option  value="{{ $emp->id }}">{{ $emp->name_kh }}--{{ $emp->name_en }}</option>
                                    @endforeach --}}
                                </select>

                            </div>

                        

                            <div class="form-group mb-2">

                                <label  for="note">
                                    {{__('lb.note')}} 
                                </label>


                                    <input type="text"  name="note" id="note" class="form-control input-xs" >


                            </div>



                        </div>
                    </div>      


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" >
                        <i class="fa fa-save"></i> {{__('lb.save')}}
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" 
                        onclick="reset('#create_form')">
                        <i class="fa fa-times"></i> {{__('lb.close')}}
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection


@endsection

@section('js')
<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
<script>

    $(document).ready(function () {
        // $("#menu_stock").addClass('menu-open');
        // $("#item").addClass('active');
        // $("#stock_in").addClass('myactive');

        $(".chosen-select").chosen({width: "100%"});
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //dataTable

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