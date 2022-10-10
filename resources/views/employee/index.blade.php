@extends('layouts.master')
@section('title')
    Employee
@endsection
@section('header')
    Employee
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
                    <th>Name KH</th>
                    <th>Name EN</th>
                    <th>Sex</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Login</th>
                    <th>Note</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
           
        </table>
	</div>
</div>

<div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog " role="document">
    <form method="POST" id='create_form'  action="{{ route('emp.store') }}" >
        @csrf

        <input type="hidden" name="tbl" value="hr_employee">
        <input type="hidden" name="per" value="hr_employee">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <strong class="modal-title">{{ __('lb.employee') }}</strong>
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
                                {{__('lb.date_record')}} <span class="text-danger">*</span>
                            </label>
                        
                            <input type="date"  name="date" id="date" class="form-control input-xs" required>
                        
                        </div>
                        <div class="form-group mb-2">
                    
                            <label for="name_kh">
                                {{__('lb.name_kh')}} <span class="text-danger">*</span>
                            </label>
                        
                            <input type="text"  name="name_kh" id="name_kh" class="form-control input-xs" required>
                        
                        </div>
                            <div class="form-group mb-2">
                    
                                <label for="name_en">
                                    {{__('lb.name_en')}} <span class="text-danger">*</span>
                                </label>
                            
                                <input type="text"  name="name_en" id="name_en" class="form-control input-xs" required>
                            
                            </div>

    

                              <div class="form-group mb-2">
            
                                    <label for="sex">
                                        {{__('lb.sex')}} <span class="text-danger">*</span>
                                    </label>
                                
                            
                                    <select name="sex_id" id="sex_id" class="chosen-select">
                                        <option value="">{{__('lb.select_one')}}</option>
                                        <option value="1">123</option>
                                
                                    </select>
                                    
                                </div>
                                
                              <div class="form-group mb-2">
            
                                <label for="position">
                                    {{__('lb.position')}} <span class="text-danger">*</span>
                                </label>
                            
                        
                                <select name="position_id" id="position_id" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    <option value="1">123</option>
                            
                                </select>
                                
                            </div>


                    </div>

                    <div class="col-sm-6">
                        <div class="form-group mb-2">
            
                            <label for="department">
                                {{__('lb.department')}} <span class="text-danger">*</span>
                            </label>
                        
                    
                            <select name="department_id" id="department_id" class="chosen-select">
                                <option value="">{{__('lb.select_one')}}</option>
                                <option value="1">123</option>
                        
                            </select>
                            
                        </div>

                        <div class="form-group mb-2">
            
                            <label for="status">
                                {{__('lb.status')}} <span class="text-danger">*</span>
                            </label>
                        
                    
                            <select name="status_id" id="status_id" class="chosen-select">
                                <option value="">{{__('lb.select_one')}}</option>
                                <option value="1">123</option>
                        
                            </select>
                            
                        </div>

                        <div class="form-group mb-2">
            
                            <label for="login">
                                {{__('lb.login')}} <span class="text-danger">*</span>
                            </label>
                        
                    
                            <select name="login_id" id="login_id" class="chosen-select">
                                <option value="">{{__('lb.select_one')}}</option>
                                <option value="1">123</option>
                        
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

@section('js')
<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "100%"});
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
@endsection