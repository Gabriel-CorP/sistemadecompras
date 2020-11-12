@extends('layouts.app')
@section('content')
<h1 class="text text-center">Editar Requesici&oacuten de compra</h1>
<div class="col-sm-12 "  >
      
    
    <div class="col-md-10 mx-auto bg-white p-3" >
    
            
            <a href="{{ route('cart.requesiciones')}}" class="btn btn-success "> Regresar</a>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar"/>
                </div>
       
    </div>

   
   
    <form method="POST" action="{{ route('cart.update', ['requesicion'=>$requesicion->id]) }}">
        @csrf
            @method('put')
            <div style="text-align:center;">
        <table class="table">  
            <thead>
                <tr>
                <th>Nombre</th>
                
                <th>Cantidad</th>
                                </tr>
                
            </thead>
            <tbody>
                @foreach($detalle as $item)
                @if($item->requesicion_id===$requesicion->id)
                <tr> 
                    <td> {{$item->nombre_articulo}}>  </td>
                    <td><input name="nueva_cantidad" type="number" min="0" max="99"value="{{$item->cantidad_articulo}}"></td>
                    <td>{{$item->unit}}</td>
                </tr> 
                @endif
                
        
    @endforeach
        
            </tbody>
        </table> 
            </div>   
    </form>
    
   
   
        
   
  
    </div>
   
  
</div>
@endsection