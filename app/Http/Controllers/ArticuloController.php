<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetalleArticulo;
use Illuminate\Support\Facades\Auth;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //para proteger los formularios
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$articulos = Auth()->user()->articulos->dd();
        
        
        
        return view('articulos.index',[
            'articulos'=>Articulo::latest()->paginate(),
            'detalles'=> DetalleArticulo::latest()->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = request()->validate([
           'nombre' => 'required|min:2',
           'unidad' => 'required',
           'precio' => 'required',
           'descuento' =>'required',
           'fechafindescuento' => 'required'
       ]);
       DetalleArticulo::create([
        'precio'=>$data['precio'],
        'descuento'=>$data['descuento'],
        'fechafindescuento'=>$data['fechafindescuento']
       ]);
       $detalle= DetalleArticulo::latest('id')->first();
       Articulo::create([
        'nombre'=>$data['nombre'],
        'unidad'=>$data['unidad'],
        'detalle_articulos_id'=>$detalle['id'],
        'user_id'=> Auth::user()->id
       ]);
       return redirect()->action('App\Http\Controllers\ArticuloController@index');
   /*    DB::table('detalle_articulos')->insert([
           'precio'=>$data['precio'],
           'descuento'=>$data['descuento'],
           'fechafindescuento'=>$data['fechafindescuento']
           ]);

           $detalle= DetalleArticulo::latest('id')->first();
*/
/*       DB::table('articulos')->insert([
           'nombre'=>$data['nombre'],
           'unidad'=>$data['unidad'],
           'detalle_articulos_id'=>$detalle['id'],
           'user_id'=> Auth::user()->id
           ]);
*/ //insertando con modelos en la BD
        //redirecion
       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        $detalle = DetalleArticulo::find($articulo->detalle_articulos_id);
        return view('articulos.edit', compact('articulo','detalle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {//revisar el policy
        $this->authorize('update',$articulo);
        //validacion 
        $data = request()->validate([
            'nombre' => 'required|min:2',
            'unidad' => 'required',
            'precio' => 'required',
            'descuento' =>'required',
            'fechafindescuento' => 'required'
        ]);
        
        $detalle= DetalleArticulo::find($articulo->detalle_articulos_id);
        $detalle->precio =$data['precio'];
        $detalle->descuento =$data['descuento'];
        $detalle->fechafindescuento =$data['fechafindescuento'];
        $detalle->save();

        $articulo-> nombre=$data['nombre'];
        $articulo-> unidad=$data['unidad'];
        $articulo->save();
        
       
        return redirect()->action('App\Http\Controllers\ArticuloController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //revisar el policy
        $this->authorize('delete',$articulo);
//eliminar el articulo
//$detalle= DetalleArticulo::find($articulo->detalle_articulos_id);


$articulo->delete();
//$detalle->delete();
return redirect()->action('App\Http\Controllers\ArticuloController@index');
    }
}
