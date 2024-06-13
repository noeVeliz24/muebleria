<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 

class ProductoController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $texto = trim($request->get('texto'));
        $productos = DB::table('mueble as m')
            ->select('m.id', 'm.nombre', 'm.material', 'm.precio', 'm.imagen')
            ->where('m.nombre', 'LIKE', '%' . $texto . '%')
            ->orderBy('m.id', 'desc')
            ->paginate(10);
            return view('almacen.producto.index', compact('productos',"texto"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias=DB::table('categoria')()->get();
        return view("almacen.producto.create",["categorias"=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoFormRequest $request)
    {
        $producto = new Producto;
        $producto->nombre = $request->input('nombre');
        $producto->material = $request->input('material');
        $producto->precio = $request->input('precio');
        $producto->imagen = $request->input('imagen');
        
        $producto->save();
        return Redirect()->route('producto.index');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        //return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $producto = Producto::findOrFail($id);
        return view("almacen.producto.edit", ["producto" => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoFormRequest $request,$id)
    {
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->input('nombre');
        $producto->material = $request->input('material');
        $producto->precio = $request->input('precio');
        $producto->imagen = $request->input('imagen');
        
        $producto->update();
        return Redirect()->route('producto.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index');
    }
}
