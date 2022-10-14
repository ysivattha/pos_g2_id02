@extends('layouts.master')
@section('title')
    {{ __('absent_type') }}
@endsection
@section('header')
    {{ __('absent_type') }}
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
       <table class="table table-sm table-bordered" style="width: 100%" id="dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.Type Absent')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
            
        </table>
       
	</div>
</div>
<!-- create model -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form  method="POST" id='create_form'  action="{{ route('absent-type.store') }}">
          @csrf
          <input type="hidden" name="tbl" value="hr_absent_type">
          <input type="hidden" name="per" value="hr_absent_type">
          <div class="modal-content">
            <div class="modal-header bg-success">
                <strong class="modal-title">{{__('lb.create_absent_type')}}</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="modal-body">
                <div id="sms">
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="absent_type_name">
                        {{__('lb.absent_type_name')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="absent_type_name" id="absent_type_name" class="form-control input-xs" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="note">
                        {{__('lb.note')}} 
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="note" id="note" class="form-control input-xs" >
                    </div>
                </div>
                 
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">
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
        $(document).ready(function () {
            // $("#sidebar li a").removeClass("active");
            // $("#menu_stock>a").addClass("active");
            // $("#menu_stock").addClass("menu-open");
            // $("#menu_unit").addClass("myactive");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        });
        //data table ;
        
        
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
                // $('#dataTable').DataTable().ajax.reload();
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


function removeD(id,obj)
{
    let con = confirm('You want to delete this record '+id+'');

    if(con)
    {
        $.ajax({
            type: 'GET', 
            url: '/cat/delete/' + id ,
            success: function(sms)
            {

                
                $('#dataTable').DataTable().ajax.reload();
            }
        });
    }
}

    </script>
@endsection