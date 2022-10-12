@extends('layouts.master')
@section('title')
    {{__('lb.item')}}
@endsection
@section('header')
    {{__('lb.item')}}
    
@endsection
@section('content')  
<link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}">
    <div class="toolbox pt-1 pb-1">
        @cancreate('item')
        <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal'>
            <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
        </button>
        @endcancreate
        @candelete('item')
        <button class="btn btn-danger btn-sm" title="Delete selected users" id='btnDelete' 
            table='roles' permission='role' token="{{csrf_token()}}">
            <i class="fa fa-trash"></i> {{__('lb.delete')}}
        </button>
        @endcandelete
    </div>   
    <div class="card">
        <div class="card-body">
            @component('coms.alert')
            @endcomponent
            <table class="table table-sm table-bordered datatable" id='dataTable' style="width: 100%">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>
                            <input type="checkbox" onclick="check(this)" value="off">
                        </th> --}}
                       
                        <th>No.</th>
                        <th>Date</th>
                        <th>Barcode</th>
                        <th>Ref_Name</th>
                        <th>Product_Name</th>
                        <th>Category</th>
                        <th>Cost_In</th>
                        <th>Price</th>
                        <th>unit</th>
                        <th>Income_Type</th>
                        <th>Note</th>
                        <th>{{__('lb.user')}}</th>
                        <th>{{__('lb.action')}}</th>

                    </tr>
                </thead>
              
            </table>
        </div>
    </div>

    {{-- modal create  --}}
    <div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog " role="document">
        <form method="POST" id='create_form'  enctype="multipart/form-data"  action="{{ route('product.store') }}">
            @csrf
    
            <input type="hidden" name="tbl" value="sto_item">
            <input type="hidden" name="per" value="sto_item">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <strong class="modal-title"> Add Record</strong>
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
                        
                                <label for="barcode">
                                    {{__('lb.barcode')}} <span class="text-danger">*</span>
                                </label>
                            
                                <input type="text"  name="barcode" id="barcode" class="form-control input-xs" required>
                            
                            </div>

                            <div class="form-group mb-2">
                        
                                <label for="ref_name">
                                    {{__('lb.ref_name')}} <span class="text-danger">*</span>
                                </label>
                            
                                <input type="text"  name="ref_name" id="ref_name" class="form-control input-xs" required>
                            
                            </div>

                            <div class="form-group mb-2">
                        
                                <label for="product_name">
                                    {{__('lb.product_name')}} <span class="text-danger">*</span>
                                </label>
                            
                                <input type="text"  name="product_name" id="product_name" class="form-control input-xs" required>
                            
                            </div>

                     

                                  <div class="form-group mb-2">
                
                                        <label  for="cost">
                                            {{__('lb.cost')}} <span class="text-danger">*</span>
                                        </label>                           
                                        <input type="number" min="0"  step="any" name="cost" id="cost" class="form-control input-xs" required>
                                        
                                    </div>

                                    <div class="form-group mb-2">
                        
                                        <label  for="price">
                                            {{__('lb.price')}}  <span class="text-danger">*</span>
                                        </label>
                                
                                    
                                        <input type="number" min="0"  step="any" name="price" class="form-control input-xs" required>
                                    
                                    </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                    
                                <label  for="unit">
                                    {{__('lb.unit')}} 
                                </label>

                                <select name="unit" id="unit" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                               
                                    @foreach ($units as $u)
                                    <option  value="{{ $u->id }}">{{ $u->unit }}</option>
                                    @endforeach
                                </select>
    
                            </div>

                            <div class="form-group mb-2">
                    
                                <label  for="category">
                                    {{__('lb.category')}} 
                                </label>

                                <select name="category" id="category" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                               
                                    @foreach ($categories as $cat)
                                    <option  value="{{ $cat->id }}">{{ $cat->category }}</option>
                                    @endforeach
                                </select>
    
                            </div>

                            <div class="form-group mb-2">
                    
                                <label  for="income">
                                    {{__('lb.income')}} 
                                </label>

                                <select name="income_type_id" id="income_type_id" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    <option  value="123">123</option>
                                    @foreach ($incomes as $in)
                                    <option  value="{{ $in->id }}">{{ $in->in_type }}</option>
                                    @endforeach
                                </select>
    
                            </div>

                            
                            <div class="form-group mb-2">
                    
                                <label  for="note">
                                    {{__('lb.note')}} 
                                </label>
                        
                                <input type="note"  name="note" id="note" class="form-control input-xs" >
                               
       
                            </div>

                            <div class="form-group mb-2">
                    
                                <label  for="image">
                                    {{__('lb.image')}} 
                                </label>
                               
                                    <input type="file"  name="image" id="image" >
                                
                             
                               
       
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
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#menu_stock>a").addClass("active");
            $("#menu_stock").addClass("menu-open");
            $("#menu_item").addClass("myactive");
            $(".chosen-select").chosen({width: "100%"});
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
                    url: "{{ route('product.index') }}",
                    type: 'GET'
                },
                columns: [
               
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'date', name: 'date'},
                    {data: 'barcode', name: 'barcode'},
                    {data: 'ref_name', name: 'ref_name'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'cat_name', name: 'category.name'},
                    {data: 'cost', name: 'cost'},
                    {data: 'price', name: 'price'},
                    {data: 'unit_name', name: 'unit.name'},
                    {data: 'income', name: 'income'},
                    {data: 'note', name: 'note'},
                    {data: 'fname', name: 'users.name'},
                    
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

        $("#create_form").submit(function(e) {
    e.preventDefault(); // prevent actual form submit
    let formData = new FormData(this);
 

    $.ajax({
         type: "POST",
         url: "{{route('product.store')}}",
         
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