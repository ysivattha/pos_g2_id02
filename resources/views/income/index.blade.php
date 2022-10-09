@extends('layouts.master')
@section('title')
    Income
@endsection
@section('header')
    Income
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
                    <th>Invoice</th>
                    <th>Item</th>
                    <th>Qty Out</th>
                    <th>Price</th>
                    <th>Amount Out</th>
                    <th>Cost</th>
                    <th>Aount Out Cost</th>
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
    <form method="POST" id='create_form'  action="{{ route('income.store') }}" >
        @csrf

        <input type="hidden" name="tbl" value="acc_income">
        <input type="hidden" name="per" value="acc_income">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <strong class="modal-title">{{ __('lb.create_stock_out') }}</strong>
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
                        
                            <input type="date"  name="date" id="date" class="form-control input-xs" required>
                        
                        </div>
                            <div class="form-group mb-2">
                    
                                <label for="invoice">
                                    {{__('lb.invoice')}} <span class="text-danger">*</span>
                                </label>
                            
                           
                                <select name="invoice_id" id="invoice_id" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    <option value="1">123</option>
                              
                                </select>
                            
                            </div>

                            <div class="form-group mb-2">
                    
                                <label for="item">
                                    {{__('lb.item')}} <span class="text-danger">*</span>
                                </label>
                            
                           
                                <select name="item_id" id="invoice_id" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    <option value="1">123</option>
                              
                                </select>
                            
                            </div>

                              <div class="form-group mb-2">
            
                                    <label  for="qty_out">
                                        {{__('lb.Qty_Out')}} <span class="text-danger">*</span>
                                    </label>                           
                                    <input type="number" min="0"  step="any" name="qty_out" id="qty_out" class="form-control input-xs" required>
                                    
                                </div>

                                <div class="form-group mb-2">
                    
                                    <label  for="price">
                                        {{__('lb.price')}}  <span class="text-danger">*</span>
                                    </label>
                            
                                
                                    <input type="number" min="0"  step="any" name="price" class="form-control input-xs">
                                
                                </div>

                                                    


                 



                    </div>

                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                                    
                            <label  for="amount_out">
                                {{__('lb.amount_out')}} 
                            </label>
                    
                      
                            <input type="number" min="0"  step="any" name="amount_out" id="amount_out" class="form-control input-xs" required>
                        
                    </div>
                        <div class="form-group mb-2">
                                    
                            <label  for="cost">
                                {{__('lb.cost')}} 
                            </label>
                    
                      
                            <input type="number" min="0"  step="any" name="cost" id="cost" class="form-control input-xs" required>
                        
                    </div>

                        
                        <div class="form-group mb-2">
                
                            <label  for="amount_out_cost">
                                {{__('lb.amount_out_cost')}} (រៀល)
                            </label>
                    
                            <input type="number"  name="amount_out_cost" id="amount_out_cost" class="form-control input-xs" >
                           
   
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