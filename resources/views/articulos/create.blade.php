@extends('layouts.app')

@section('botones')
    <a href="{{ route('articulos.index') }}" class="btn btn-primary mr-2"> volver</a>
@endsection

@section('content')

    <h2 class="text-center mb-5"> Ofertar nuevo articulo</h2>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <form method="POST" action="{{ route('articulos.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre articulo</label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Articulo" value="{{ old('nombre') }}"/>
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                @enderror

                <label for="unidad">Unidad de medida del articulo</label>
                <input type="text" name="unidad" class="form-control" id="unidad" placeholder="Unidad de medidad" value="{{ old('unidad') }}"/>
                @error('unidad')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                @enderror

                <label for="precio">Precio de venta del articulo</label>
                <input type="text" name="precio" class="form-control" id="precio" placeholder="Precio del Articulo" value="{{ old('precio') }}"/>
                    @error('precio')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                @enderror

                <label for="descuento">Descuento ofrecido por el articulo</label>
                <input type="text" name="descuento" class="form-control" id="descuento" placeholder="Descuento del Articulo ##.##" value="{{ old('descuento') }}"/>
                @error('descuento')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                @enderror

                <label for="fechafindescuento">fecha de finalizacion del descuento</label>
                <input type="date" name="fechafindescuento" class="form-control" id="fechafindescuento" placeholder="fecha de finalizacion del descuento" value="{{ old('fechafindescuento') }}"/>
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                @enderror
            </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="agregar"/>
                </div>
        </form> 
            
        </div>
    </div>

    
@endsection