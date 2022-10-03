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
       <table class="table table-sm table-bordered" style="width: 100%" id="supplier_table">
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
                   
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
           
        </table>
	</div>
</div>




@endsection

@section('modal')
<div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
 <div class="modal-dialog " role="document">
 <form method="POST" id='create_form'   action="{{ route('supplier.store') }}">
     @csrf

     <input type="hidden" name="tbl" value="sup_supplier">
     <input type="hidden" name="per" value="sup_supplier">
     <div class="modal-content">
         <div class="modal-header bg-success">
             <strong class="modal-title">{{ __('lb.create_customer') }}</strong>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">


             <div id="sms">
             </div>
  

             
             <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group mb-2">
                 
                         <label for="date">
                             {{__('lb.date')}} <span class="text-danger">*</span>
                         </label>
                     
                         <input type="date"  name="date" id="date" class="form-control input-xs" required>
                     
                     </div>

                     <div class="form-group mb-2">
                 
                         <label for="company_name">
                             {{__('lb.company_name')}} <span class="text-danger">*</span>
                         </label>
                     
                         <input type="text"  name="company_name" id="company_name" class="form-control input-xs" required>
                     
                     </div>

                     <div class="form-group mb-2">
                 
                         <label for="contact_name">
                             {{__('lb.contact_name')}} <span class="text-danger">*</span>
                         </label>
                     
                         <input type="text"  name="contact_name" id="contact_name" class="form-control input-xs" required>
                     
                     </div>

                     <div class="form-group mb-2">
                 
                         <label for="phone">
                             {{__('lb.phone')}}
                         </label>
                     
                         <input type="text"  name="phone" id="phone" class="form-control input-xs" >
                     
                     </div>

                     <div class="form-group mb-2">
                 
                         <label for="type_id">
                             {{__('lb.type_id')}}
                         </label>
                     
                         <select name="type_id" id="type_id" class="chosen-select">
                             <option value="">{{__('lb.select_one')}}</option>
                             @foreach ($sup_type as $sup)
                             <option value="{{ $sup->id }}">{{ $sup->s_type }}</option>
                             @endforeach
                             
                         </select>
                     
                     </div>

                     <div class="form-group mb-2">
                 
                         <label for="address">
                             {{__('lb.address')}}
                         </label>
                     
                         <input type="text"  name="address" id="address" class="form-control input-xs" >
                     
                     </div>

                     <div class="form-group mb-2">
                 
                         <label for="note">
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

@section('js')
<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
<script>
    $(".chosen-select").chosen({width: "100%"});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // get unit
    var table = $('#supplier_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('supplier.index') }}",
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
                data: 'company_name',
                name: 'company_name'
            },
            {
                data: 'contact_name',
                name: 'contact_name'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 's_type',
                name: 's_type'
            },
            {
                data: 'address',
                name: 'address'
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
                $('#dataTable').DataTable().ajax.reload();
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
@endsection