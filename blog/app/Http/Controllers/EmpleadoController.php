<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();
        return response()->json($empleados, 200);
    }

    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return response()->json($empleado, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $empleado = new Empleado();
        $empleado->nombre = $request->nombre;
        $empleado->save();

        return response()->json($empleado, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->nombre = $request->nombre;
        $empleado->save();

        return response()->json($empleado, 200);
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return response()->json(null, 204);
    }
}
