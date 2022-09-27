@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('header')
    Dashboard
@endsection
@section('content')
<div class="card mt-2">
    <div class="card-body">
    <div class="row">
            <div class="col-md-2">
            
            </div>
      
</div>
<hr>
        <div class="row">
            
        </div>
      
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#sidebar li a").removeClass("active");
            $("#menu_home").addClass("active");
        });
    </script>
@endsection