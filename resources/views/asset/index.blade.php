@extends('layouts.master')
@section('title')
    {{__('lb.Asset')}}
@endsection
@section('header')
    {{__('lb.Asset')}}
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
                    <th>{{__('lb.asset_name')}}</th>
                    <th>{{__('lb.asset_code')}}</th>
                    <th>{{__('lb.qty')}}</th>
                    <th>{{__('lb.price')}}</th>
                    <th>{{__('lb.amount')}}</th>
                    <th>{{__('lb.date_expire')}}</th>
                   
                    <th>{{__('lb.qty_month_use')}}</th>
                    <th>{{__('lb.depreciation_amount')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
        </table>
        

	</div>

    
</div>

@section('modal')
    <div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
        <form method="POST" id='create_form'  action="{{ route('asset.store') }}" >
            @csrf

            <input type="hidden" name="tbl" value="acc_asset_list">
            <input type="hidden" name="per" value="acc_asset_list">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <strong class="modal-title">{{ __('lb.create_asset') }}</strong>
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

                                        <label  for="date">
                                            {{__('lb.date')}} <span class="text-danger">*</span>
                                        </label>                           
                                        <input type="date"  name="date" id="date" class="form-control input-xs" required>

                                    </div>

                                    <div class="form-group mb-2">

                                        <label  for="asset_name">
                                            {{__('lb.asset_name')}}  <span class="text-danger">*</span>
                                        </label>


                                        <input type="text"  name="asset_name" class="form-control input-xs">

                                    </div>

                                    <div class="form-group mb-2">

                                        <label  for="asset_code">
                                            {{__('lb.asset_code')}}  <span class="text-danger">*</span>
                                        </label>


                                        <input type="text"  name="asset_code" class="form-control input-xs">

                                    </div>
                                    <div class="form-group mb-2">

                                        <label  for="qty">
                                            {{__('lb.qty')}}  <span class="text-danger">*</span>
                                        </label>


                                        <input type="number" min="0" step="any" name="qty" class="form-control input-xs">

                                    </div>


                                    <div class="form-group mb-2">

                                            <label  for="price">
                                                {{__('lb.price')}} 
                                            </label>


                                            <input type="price" min="0"  step="any" name="price" id="price" class="form-control input-xs" required>

                                    </div>

                                    <div class="form-group mb-2">

                                        <label  for="amount">
                                            {{__('lb.amount')}} 
                                        </label>


                                            <input type="number" min="0"  step="any" name="amount"  id="amount" class="form-control input-xs" required>


                                    </div>

         



                        </div>

                        <div class="col-sm-6">
    

                            <div class="form-group mb-2">

                                    <label  for="date_expired">
                                        {{__('lb.date_expired')}} 
                                    </label>


                                        <input type="date"  name="date_expired" id="date_expired" class="form-control input-xs" required>


                            </div>

                            <div class="form-group mb-2">

                                <label  for="qty_month_use">
                                    {{__('lb.qty_month_use')}} 
                                </label>


                                    <input type="number"  name="qty_month_use" id="qty_month_use" class="form-control input-xs" >


                            </div>

                            <div class="form-group mb-2">

                                <label  for="depreciation_amount">
                                    {{__('lb.depreciation_amount')}} 
                                </label>


                                    <input type="number"  name="depreciation_amount" id="depreciation_amount" class="form-control input-xs" >


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
    $(document).ready(function(){

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