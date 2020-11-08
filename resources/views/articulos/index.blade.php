@extends('layouts.app')

@section('botones')
    <a href="{{ route('articulos.create') }}" class="btn btn-primary mr-2"> Agregar</a>
@endsection


@section('content')

    <h2 class="text-center mb-5"> Administra tus articulos</h2>
    
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead>
                <tr>
                    <th schole="col">Nombre</th>
                    <th schole="col">Unidad</th>
                    <th schole="col">Precio en USD</th>
                    <th schole="col">porcentanje de descuento</th>
                    <th schole="col">Valido hasta</th>
                    <th schole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articulos as $articulo)
                    <tr>
                        <td>{{$articulo->nombre}} </td>
                        <td>{{$articulo->unidad}}</td> 
                        @foreach($detalles as $detalle)
                         @if($articulo->detalle_articulos_id===$detalle->id)                                             
                            <td>{{$detalle->precio}}</td>
                            <td>{{$detalle->descuento}}</td>
                            <td>{{$detalle->fechafindescuento}}</td>
                            <td> 
                                <a href=" {{ route('articulos.edit', ['articulo'=>$articulo->id]) }} " class=" btn btn-success mb-2 w-75"> Editar </a>
                                <form action=" {{ route('articulos.destroy', [ 'articulo'=>$articulo->id]) }} " method="POST">
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