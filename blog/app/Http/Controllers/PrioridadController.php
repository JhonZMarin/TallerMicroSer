<?php

namespace App\Http\Controllers;

use App\Models\Prioridad;
use Illuminate\Http\Request;

class PrioridadController extends Controller
{
    public function index()
    {
        $prioridades = Prioridad::all();
        return response()->json($prioridades, 200);
    }

    public function show($id)
    {
        $prioridad = Prioridad::findOrFail($id);
        return response()->json($prioridad, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $prioridad = new Prioridad();
        $prioridad->nombre = $request->nombre;
        $prioridad->save();

        return response()->json($prioridad, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $prioridad = Prioridad::findOrFail($id);
        $prioridad->nombre = $request->nombre;
        $prioridad->save();

        return response()->json($prioridad, 200);
    }

    public function destroy($id)
    {
        $prioridad = Prioridad::findOrFail($id);
        $prioridad->delete();

        return response()->json(null, 204);
    }
}
