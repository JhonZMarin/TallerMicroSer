<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::all();
        return response()->json($estados, 200);
    }

    public function show($id)
    {
        $estado = Estado::findOrFail($id);
        return response()->json($estado, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $estado = new Estado();
        $estado->nombre = $request->nombre;
        $estado->save();

        return response()->json($estado, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $estado = Estado::findOrFail($id);
        $estado->nombre = $request->nombre;
        $estado->save();

        return response()->json($estado, 200);
    }

    public function destroy($id)
    {
        $estado = Estado::findOrFail($id);
        $estado->delete();

        return response()->json(null, 204);
    }
}
