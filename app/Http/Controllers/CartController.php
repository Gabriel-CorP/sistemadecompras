<?php

namespace App\Http\Controllers;
use App\Models\Articulo;
use Illuminate\Http\Request;

use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    public function index(){
        $articulos=Articulo::all();

        return view('catalogo', compact('articulos'));

        }

    public function add(Request $request){

        $arti= Articulo::find($request->articulo_id);

        \Cart::add($arti->id,
        $arti->nombre,
        $arti->unidad,
        1

        );
        

        return back();
    }

}
