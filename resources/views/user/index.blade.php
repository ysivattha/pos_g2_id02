@extends('layouts.master')
@section('title')
    {{__('lb.users')}}
@endsection
@section('header')
    {{__('lb.users')}}
@endsection
@section('content')
<!-- js chosen -->
<link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}">
<div class="toolbox pt-1 pb-1">
    @cancreate('user')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate
    @candelete('user')
    <button class="btn btn-danger btn-sm" title="Delete selected users" id='btnDelete' 
        table='users' permission='user' token="{{csrf_token()}}">
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
                        <th>
                            <input type="checkbox" onclick="check(this)" value="off">
                        </th>
                        <th>#</th>
                       
                        <th>User_Name <!-- {{__('lb.photo')}} --></th>
                        <th>{{__('lb.signature')}}</th>
                        <th>{{__('lb.code')}}</th>
                        <th>{{__('lb.first_name')}}</th>
                        <th>{{__('lb.last_name')}}</th>
                        <th>{{__('lb.gender')}}</th>
                        <th>{{__('lb.username')}}</th>
                        <th>{{__('lb.email')}}</th>
                        <th>{{__('lb.phone')}}</th>
                        <th>{{__('lb.role')}}</th>
                        <th>{{__('lb.hospitals')}}</th>
                        <th>{{__('lb.action')}}</th>
                    </tr>
                </thead>
                
            </table>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(".chosen-select").chosen({width: "100%"});
            $("#sidebar li a").removeClass("active");
            $("#menu_security>a").addClass("active");
            $("#menu_security").addClass("menu-open");
            $("#menu_user").addClass("myactive");
           
            $("#edepartment_id").change(function () {
                eget_section();
            });
			var table = $('#dataTable').DataTable({
                pageLength: 50,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'check', name: 'check', searchable: false, orderable: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {
                        data: 'photo', 
                        name: 'photo', 
                        orderable: false, 
                        searchable: false
                    },
                    {data: 'signature', name: 'signature'},
                    {data: 'code', name: 'code'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'rname', name: 'roles.name'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ],
                
            });
        });
    // function to get sub category
   
    function preview(e){
        var img = document.getElementById('img');
        img.src = URL.createObjectURL(e.target.files[0]);
    }
    function epreview(e){
        var img = document.getElementById('eimg');
        img.src = URL.createObjectURL(e.target.files[0]);
    }
    // function to save data from a form
    function create_user(evt)
    {
        var form = $('#create_form')[0];
        var formData = new FormData(form);
        evt.preventDefault();
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: "{{route('user.store')}}",
            data: formData,
            processData: false,
            contentType: false,
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
                    var img = document.getElementById('img');
                    img.src = null;
                    $('#hospital_id').val('');
                    $('#department_id').val('');
                    $('#position_id').val('');
                    $("#hospital_id").trigger("chosen:updated");
                    $("#department_id").trigger("chosen:updated");
                    $("#position_id").trigger("chosen:updated");
                    $("#create_form")[0].reset();
                    $('#dataTable').DataTable().ajax.reload();
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
    }
    function edit(id, obj)
    {
        $('#esms').html('');
        let tbl = $(obj).attr('table');
        $.ajax({
            type: 'GET',
            url: burl + '/bulk/get/' + id + '?tbl=' + tbl,
            success: function(sms)
            {
                let data = JSON.parse(sms);
                $('#eid').val(data.id);
                $('#efirst_name').val(data.first_name);
                $('#ecode').val(data.code);
                $('#elast_name').val(data.last_name);
                $('#egender').val(data.gender);
                $('#eemail').val(data.email);
                $('#ephone').val(data.phone);
                $('#eusername').val(data.username);
                $('#ehospital_id').val(data.hospital_id);
                $('#edepartment_id').val(data.department_id);
                $('#eposition_id').val(data.position_id);
                $('#eusername').val(data.username);
                $('#erole_id').val(data.role_id);
                $("#ehospital_id").trigger("chosen:updated");
                $("#edepartment_id").trigger("chosen:updated");
                $("#eposition_id").trigger("chosen:updated");
                var img = document.getElementById('eimg');
                img.src = burl + '/' + data.photo;
            }
        });
    }
    // function to save data from a form
    function update_user(evt)
    {
        var form = $('#edit_form')[0];
        var formData = new FormData(form);
        evt.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{route('user.update')}}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(sms){
                if(sms>0)
                {
                    var img = document.getElementById('img');
                    img.src = null;
                    $("#edit_form")[0].reset();
                    $('#dataTable').DataTable().ajax.reload();
                    $('#editModal').modal('hide');
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
                    $('#esms').html(txt);
                }
                
            }
        });
    }
    </script>
@endsection