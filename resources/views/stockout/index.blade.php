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
    {{-- @cancreate('item')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate --}}

    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
</div>



</div>  
</div>   
<div class="card">
	
	<div class="card-body">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered" style="width: 100%" id="stock_out_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.customer')}}</th>
                    <th>{{__('lb.amount')}}</th>
                    <th>{{__('lb.discount')}}</th>
                    <th>{{__('lb.total')}}</th>
                    <th>{{__('lb.tax')}}</th>
                    <th>{{__('lb.total-tax')}}</th>
                    <th>{{__('lb.seller')}}</th>
                    <th>{{__('lb.paid')}}</th>
                    <th>{{__('lb.rest')}}</th>
                    <th>{{__('lb.note')}}</th>
                  
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
          
        </table>
	</div>
</div>

@section('modal')
    <div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
        <form method="POST" id='create_form'  action="{{ route('stockout.store') }}" >
            @csrf
    
            <input type="hidden" name="tbl" value="sto_stock_out">
            <input type="hidden" name="per" value="sto_stock_out">
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
                        
                                    <label for="customer">
                                        {{__('lb.customer')}} <span class="text-danger">*</span>
                                    </label>
                                
                               
                                    <select name="customer" id="customer" class="chosen-select">
                                        <option value="">{{__('lb.select_one')}}</option>
                                        <option value="1">123</option>
                                        @foreach ($customers as $cus)
                                        <option value="{{ $cus->id }}">{{ $cus->contact_name }}</option>
                                        @endforeach
                                    </select>
                                
                                </div>

                                  <div class="form-group mb-2">
                
                                        <label  for="amount">
                                            {{__('lb.amount')}} <span class="text-danger">*</span>
                                        </label>                           
                                        <input type="number" min="0"  step="any" name="amount" id="amount" class="form-control input-xs" required>
                                        
                                    </div>

                                    <div class="form-group mb-2">
                        
                                        <label  for="discount">
                                            {{__('lb.discount')}}  <span class="text-danger">*</span>
                                        </label>
                                
                                    
                                        <input type="number" min="0"  step="any" name="discount" class="form-control input-xs">
                                    
                                    </div>

                                                        
                                    <div class="form-group mb-2">
                                        
                                            <label  for="total">
                                                {{__('lb.total')}} 
                                            </label>
                                    
                                      
                                            <input type="number" min="0"  step="any" name="total" id="total" class="form-control input-xs" required>
                                        
                                    </div>

                                    <div class="form-group mb-2">
                    
                                        <label  for="tax">
                                            {{__('lb.tax')}} 
                                        </label>
                                
                                      
                                            <input type="number" min="0"  step="any" name="tax"  id="tax" class="form-control input-xs" required>
                                        
                
                                    </div>

                                    <div class="form-group mb-2">
                    
                                        <label  for="total_with_tax">
                                            {{__('lb.total_with_tax')}} 
                                        </label>
                                
                                        
                                            <input type="number" min="0"  step="any" name="total_with_tax" id="total_with_tax" class="form-control input-xs" required>
                                       
                
                                    </div>



                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                    
                                <label  for="exchange_rate">
                                    {{__('lb.exchange_rate')}} 
                                </label>

                                <select name="exchange_rate" id="exchange_rate" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    <option value="1">123</option>
                                    @foreach ($exchanges as $ex)
                                    <option class="{{ $ex->is_active==1?'bg-info':'' }}" value="{{ $ex->id }}">${{ $ex->dollar }}={{ $ex->khr }}</option>
                                    @endforeach
                                </select>
                        
                               
                                  
                               
       
                            </div>

                            
                            <div class="form-group mb-2">
                    
                                <label  for="amount_khr">
                                    {{__('lb.amount')}} (រៀល)
                                </label>
                        
                                <input type="number"  name="amount_khr" id="amount_khr" class="form-control input-xs" >
                               
       
                            </div>
                            <div class="form-group mb-2">
                    
                                <label  for="seller">
                                    {{__('lb.seller')}} 
                                </label>
                        
                         
                                    <select name="seller" id="seller" class="chosen-select">
                                        <option value="">{{__('lb.select_one')}}</option>
                                        <option value="1">123</option>
                                        @foreach ($emps as $emp)
                                        <option value="{{ $emp->id }}">123</option>
                                        @endforeach
                                    </select>
                               
        
                            </div>

                            <div class="form-group mb-2">
                    
                                    <label  for="paid">
                                        {{__('lb.paid')}} 
                                    </label>
                            
                                    
                                        <input type="number"  name="paid" id="paid" class="form-control input-xs" required>
                                    

                            </div>

                            <div class="form-group mb-2">
                    
                                <label  for="rest">
                                    {{__('lb.rest')}} 
                                </label>
                        
                                
                                    <input type="number"  name="rest" id="rest" class="form-control input-xs" >
                                
        
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

    $("#menu_stock").addClass('menu-open');
        $("#item").addClass('active');
        $("#stock_out").addClass('myactive');

        $(".chosen-select").chosen({width: "100%"});
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // get unit
    var table = $('#stock_out_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('stockout.index') }}",
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
                data: 'fname',
                name: 'fname'
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
                $('#stock_out_table').DataTable().ajax.reload();
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

});

function totalOnchange()
{
    var totalTax = $('#total_with_tax').val();
    alert(totalTax);
};
       

</script>
@endsection