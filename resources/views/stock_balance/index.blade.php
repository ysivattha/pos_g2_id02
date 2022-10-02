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
       <table class="table table-sm table-bordered" style="width: 100%" id="balance_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.item')}}</th>
                    <th>{{__('lb.Qty-Begin')}}</th>
                    <th>{{__('lb.Qty-Add')}}</th>
                    <th>{{__('lb.qty_minus')}}</th>
                    <th>{{__('lb.qty_balance')}}</th>
                    <th>{{__('lb.note')}}</th>
                   
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
           
        </table>
	</div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form  method="POST" id='create_form'  action="{{ route('balance.store') }}">
          @csrf
          <input type="hidden" name="tbl" value="sto_stock_balance">
          <input type="hidden" name="per" value="sto_stock_balance">
          <div class="modal-content">
            <div class="modal-header bg-success">
                <strong class="modal-title">{{__('lb.Stock_Balance')}}</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="modal-body">
                <div id="sms">
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="date">
                        {{__('lb.date')}} <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="date" name="date" id="date" class="form-control input-xs" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="item_id">
                        {{__('lb.item')}} 
                    </label>
                    <div class="col-md-9">
                        <select name="item_id" id="item_id" class="chosen-select ">
                            <option value="">{{__('lb.select_one')}}</option>
                            @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

   
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="qty_begin">
                        {{__('lb.qty_begin')}}
                    </label>
                    <div class="col-md-9">
                        <input type="number" min="0"  name="qty_begin" id="qty_begin" class="form-control input-xs" >
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-md-3" for="qty_add">
                        {{__('lb.qty_add')}}
                    </label>
                    <div class="col-md-9">
                        <input type="number" min="0" name="qty_add" id="qty_add" class="form-control input-xs" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" for="qty_minus">
                        {{__('lb.qty_minus')}} 
                    </label>
                    <div class="col-md-9">
                        <input type="number" min="0" name="qty_minus" id="qty_minus" class="form-control input-xs" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="qty_balance">
                        {{__('lb.qty_balance')}} 
                    </label>
                    <div class="col-md-9">
                        <input type="number" min="0" name="qty_balance" id="qty_balance" class="form-control input-xs" >
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" for="note">
                        {{__('lb.note')}}
                    </label>
                    <div class="col-md-9">
                        <input type="note" name="note" id="note" class="form-control input-xs" >
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
    $(".chosen-select").chosen({width: "100%"});
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // get unit
    var table = $('#balance_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('balance.index') }}",
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
                data: 'product_name',
                name: 'product_name'
            },
            {
                data: 'qty_begin',
                name: 'qty_begin'
            },
            {
                data: 'qty_add',
                name: 'qty_add'
            },
            {
                data: 'qty_minus',
                name: 'qty_minus'
            },
            {
                data: 'qty_balance',
                name: 'qty_balance'
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
                $('#balance_table').DataTable().ajax.reload();
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