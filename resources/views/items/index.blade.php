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
       <table class="table table-sm table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('lb.image')}}</th>
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.barcode')}}</th>
                    <th>{{__('lb.ref_name')}}</th>
                    <th>{{__('lb.product_name')}}</th>
                    <th>{{__('lb.cost')}}</th>
                    <th>{{__('lb.price')}}</th>
                    <th>{{__('lb.unit')}}</th>
                   
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
            <tbody>			
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = config('app.row') * ($pagex - 1) + 1;
                    
                ?>
                @foreach($item as $items)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img src="{{ asset($items->image) }}" width="40px">
                        </td>
                       <td>{{ $items->date }}</td>
                       <td>{{ $items->barcode }}</td>
                       <td>{{ $items->ref_name }}</td>
                       <td>{{ $items->product_name }}</td>
                       <td>{{ $items->cost }}</td>
                       <td>{{ $items->price }}</td>
                       <td>{{ $items->unit }}</td>
                       <td>{{ $items->note }}</td>
                       <td>{{ $items->user }}</td>
                        <td class="text-left">
                            <a href="#" title="{{__('lb.edit')}}"  onclick="edit({{$items->id}}, this)" data-toggle='modal' data-target='#editModal' class='btn btn-success btn-xs'
                             >
                                <i class="fa fa-edit"></i>
                            </a>
                             @candelete('request')
                            
                            <a href="{{url('item/delete', $items->id)}}" class="btn btn-danger btn-xs" onclick="return confirm('You want to delete?')" title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                            @endcandelete
                        </td>
                    </tr>
                  
                @endforeach
             
            </tbody>
        </table> <br>
        {{-- {{$item->links('pagination::bootstrap-4')}} --}}
        </table>
	</div>
</div>




@endsection

@section('js')

@endsection