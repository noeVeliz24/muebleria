<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Mueble;
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
        $texto = trim($request->get('texto'));
        $muebles = DB::table('mueble')
            ->select('id', 'nombre', 'material', 'precio', 'imagen')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('material', 'LIKE', '%' . $texto . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('tiendamuebles.mueble.index', compact('muebles', 'texto'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tiendamuebles.mueble.create");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'material' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $mueble = new Mueble;
        $mueble->nombre = $request->input('nombre');
        $mueble->material = $request->input('material');
        $mueble->precio = $request->input('precio');

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::slug($request->nombre) . '.' . $imagen->guessExtension();
            $ruta = public_path('/imagenes/muebles/');

            $imagen->move($ruta, $nombreImagen);

            $mueble->imagen = $nombreImagen;
        }

        $mueble->save();
        return Redirect()->route('muebles.index')->with('success', 'Mueble creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mueble = Mueble::findOrFail($id);
        return view('tiendamuebles.mueble.show', compact('mueble'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mueble = Mueble::findOrFail($id);
        return view("tiendamuebles.mueble.edit", compact('mueble'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'material' => 'required|string|max:100',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $mueble = Mueble::findOrFail($id);
        $mueble->nombre = $request->input('nombre');
        $mueble->material = $request->input('material');
        $mueble->precio = $request->input('precio');

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::slug($request->nombre) . '.' . $imagen->guessExtension();
            $ruta = public_path('/imagenes/muebles/');

            $imagen->move($ruta, $nombreImagen);

            $mueble->imagen = $nombreImagen;
        }

        $mueble->update();
        return Redirect()->route('muebles.index')->with('success', 'Mueble actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mueble = Mueble::findOrFail($id);
        $mueble->delete();
        return redirect()->route('muebles.index')->with('success', 'Mueble eliminado con éxito.');
    }
}
