@extends('layouts.master')
@section('title')
    {{__('lb.my_profile')}}
@endsection
@section('header')
    {{__('lb.my_profile')}}
@endsection
@section('content')
<form action="{{url('user/profile/update')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="toolbox pt-1 pb-1">
    <button class="btn btn-primary btn-sm">
        <i class="fa fa-save"></i> {{__('lb.save')}}
    </button>
   
</div>
<div class="card">
    <div class="card-body">
        @component('coms.alert')
        @endcomponent
        <div class="row">
            
        </div>
    </div>
</div>
</form>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar li a").removeClass("active");
            $("#menu_security>a").addClass("active");
            $("#menu_security").addClass("menu-open");
            $("#menu_user").addClass("myactive");
        });
        
    </script>
@endsection
