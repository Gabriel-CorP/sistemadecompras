@extends('layouts.app')
@section('content')
<div class="row">
   <div class="col-sm-3">
      
    @if(count(\Cart::getContent()) > 0 )

        {{count(\Cart::getContent())}}
        
    @endif

   </div>
   <div class="col-sm-10" >
    <div class="row">
        @forelse($articulos as $item)
    <div class="col-4 border p-5 mt-5 text-center" >
    <h1>{{$item->nombre}}</h1>
    <p>{{$item->unidad}} </p>
    <form action="{{route('cart.add')}}" method="POST">
        @csrf
    <input type="hidden" name="articulo_id" value="{{$item->id}}" >
    <input type="submit" name="btn" class="btn btn-success" value="Agregar a requesicion">
    </form>
    </div>
        
    @empty
        
    @endforelse
    </div>
    
   </div>
   
   
  
</div>
@endsection