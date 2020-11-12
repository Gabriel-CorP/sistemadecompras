@extends('layouts.app')
@section('content')
<h1 class="text text-center">Requesici&oacuten de compra</h1>
<div class="col-sm-12">
      
    @if(count(\Cart::getContent()) > 0 )
    <div class="col-sm-6 p-2" >
    
            <a href="{{ route('cart.procesarrequesicion')}}" class="btn btn-danger"> Enviar a Jefe superior</a>
            <a href="{{ route('carrito.index')}}" class="btn btn-success "> Agregar mas articulos</a>

       
    </div>

<div class="row">
   
<table class="table table-striped">  
    <thead>
        <tr>
        <th>ID</th>
        <th>Nombre</th>
        
        <th>Cantidad</th>
        <th>Unidad</th>
        </tr>
        
    </thead>
    <tbody>
        @foreach(\Cart::getContent() as $item)
        <tr> 
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        
        <td>{{$item->quantity}}</td>
        <td>{{$item->unit}}</td>
        </tr>
            
        @endforeach
    </tbody>
</table>    




   
    @else 

    <p> Requesicion sin productos</p>    
    @endif

   </div>
   <div class="col-sm-10" >
    <div class="row">
      
    </div>
    
   </div>
   
   
  
</div>
@endsection