<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use App\Models\DetalleArticulo;
use App\Models\LineaDeRequesicion;
use App\Models\Requesicion;
use App\Models\User;
use Illuminate\Http\Request;

use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $articulos=Articulo::all();
        

        return view('catalogo', compact('articulos'));

        }

    public function add(Request $request){

        $arti= Articulo::find($request->articulo_id);
        $detalles=DetalleArticulo::find($arti->detalle_articulos_id);
        $cant=$request->articulo_cantidad;
        \Cart::add($arti->id,
        $arti->nombre,
        $detalles->precio,
        $cant,
        $arti->unidad,
        

        );
        

        return back();
    }

    public function checkout(){
        
        return view('carrito.cart-checkout');

    }

    public function removeitem(){

    }
    public function procesarrequesicion(Request $request){
        if(\Cart::getContent()->count()>0):
            foreach (\Cart::getContent() as $r) {
              
                $requesicion= new Requesicion();
                $requesicion->elaborador_id=Auth::user()->id;
                $requesicion->estado="En espera";
                $requesicion->aprobador_id=88;
                $requesicion->comentario="algo";
                $requesicion->save();
               
              
                   $id_req= Requesicion::latest('id')->first();
                /*
                 Requesicion::create([
                    'elaborador_id'=>Auth::user()->id,
                    'estado'=>"En espera",
                    
                   ]);
                $requesicion= new Requesicion();
                $requesicion->elaborador_id=Auth::user()->id;
                $requesicion->estado="En espera";
                $requesicion->save();
                $id_req= Requesicion::latest('id')->first();
                */
                foreach (\Cart::getContent() as $s) {
                   
                        LineaDeRequesicion::create([
                        'nombre_articulo'=>$s->name,
                        'unidad_articulo'=>$s->unit,
                        'cantidad_articulo'=>$s->quantity,
                        'requesicion_id'=>$id_req['id']
                        
                       ]);
                    /* $linea =new LineaDeRequesicion();
                    $linea->nombre_articulo=$s->name;
                    $linea->unidad_articulo=$s->unit;
                    $linea->cantidad_articulo=$s->quantity;
                    $linea->requesicion_id=$id_req['id'];
                    */
                }
            }
            \Cart::clear();

            return redirect()->action('App\Http\Controllers\CartController@index');
    else:
        redirect('/cart-checkout');
    endif;

    }
    public function requesiciones(){
        return view('carrito.index',[
            'requesiciones'=>Requesicion::latest()->paginate(),
            'usuarios'=>User::latest()->paginate()
            ]);
    }

    public function edit(Requesicion $requesicion)
    {
       
        return view('requesicion.edit', ['requesicion'=>$requesicion,
        'detalle'=>LineaDeRequesicion::latest()->paginate()
        ]);
    }

    public function update(Request $request, Requesicion $requesicion)
    {//revisar el policy
        //$this->authorize('update',$articulo);
        //validacion 
                
        $detalle= LineaDeRequesicion::find($requesicion->id);
        $detalle->precio =$data['precio'];
        $detalle->descuento =$data['descuento'];
        $detalle->fechafindescuento =$data['fechafindescuento'];
        $detalle->save();

        $articulo-> nombre=$data['nombre'];
        $articulo-> unidad=$data['unidad'];
        $articulo->save();
        
       
        return redirect()->action('App\Http\Controllers\CartController@requesiciones');
    }

    public function destroy(Requesicion $requesicion)
    {

$requesicion->delete();
//$detalle->delete();
return redirect()->action('App\Http\Controllers\ArticuloController@index');
    }

}
