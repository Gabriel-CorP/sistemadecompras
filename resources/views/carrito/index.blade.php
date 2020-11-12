@extends('layouts.app')

@section('botones')
    <a href="{{ route('carrito.index') }}" class="btn btn-primary mr-2"> Crear requesicion</a>
@endsection
{{$requesiciones}}

@section('content')

    <h2 class="text-center mb-5"> Administra tus Requesiciones</h2>
    
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead>
                <tr>
                    <th schole="col">Estado de la requesicion</th>
                    <th schole="col">Comentario</th>
                    <th schole="col">Nombre del creador</th>
                    <th schole="col">Acciones</th>

                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach($requesiciones as $requesicion)
                    <tr>
                        <td>{{$requesicion->estado}} </td>
                        <td>{{$requesicion->comentario}} </td>
                        @foreach($usuarios as $usuario)
                         @if($requesicion->elaborador_id===$usuario->id)                                             
                            <td>{{$usuario->name}}</td>
                            
                            <td> 
                                <a href=" {{ route('cart.edit', ['requesicion'=>$requesicion->id]) }} " class=" btn btn-success mb-2 w-75"> Editar </a>
                                <form action=" {{ route('cart.destroy', [ 'requesicion'=>$requesicion->id]) }} " method="POST">
                                    @csrf
                                    @method('delete')
                                <input type="submit" class=" btn btn-danger mb-2 w-75" value="Eliminar">
                                </form> 
                           
                            </td>
                         @endif
                         @endforeach
                        
                    </tr>

                @endforeach
               
@endsection