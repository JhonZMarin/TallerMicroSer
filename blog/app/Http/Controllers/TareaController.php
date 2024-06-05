<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fechaEstimadaFinalizacion' => 'required|date',
            'creadorTarea' => 'required',
            'idEmpleado' => 'required|exists:empleados,id',
            'idEstado' => 'required|exists:estados,id',
            'idPrioridad' => 'required|exists:prioridades,id'
        ]);

        $tarea = new Tarea();
        $tarea->fill($request->all());
        $tarea->created_at = now();
        $tarea->save();

        return response()->json($tarea, 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fechaEstimadaFinalizacion' => 'required|date',
            'creadorTarea' => 'required',
            'idEmpleado' => 'required|exists:empleados,id',
            'idEstado' => 'required|exists:estados,id',
            'idPrioridad' => 'required|exists:prioridades,id'
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->fill($request->all());
        $tarea->save();

        return response()->json($tarea, 200);
    }

    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return response()->json(null, 204);
    }

    public function listarPorPrioridadYFecha()
    {
        $tareas = Tarea::orderBy('idPrioridad', 'desc')
            ->orderBy('fechaEstimadaFinalizacion', 'asc')
            ->get();

        return response()->json($tareas, 200);
    }

    public function buscar(Request $request)
    {
        $query = Tarea::query();

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fechaEstimadaFinalizacion', [$request->fecha_inicio, $request->fecha_fin]);
        }

        if ($request->filled('idPrioridad')) {
            $query->where('idPrioridad', $request->idPrioridad);
        }

        if ($request->filled('idEmpleado')) {
            $query->where('idEmpleado', $request->idEmpleado);
        }

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }

        $resultados = $query->get();

        return response()->json($resultados, 200);
    }

    public function tareasPorEstado()
    {
        $tareasPorEstado = DB::table('tareas')
            ->join('estados', 'tareas.idEstado', '=', 'estados.id')
            ->select('estados.nombre as estado', DB::raw('count(*) as total'))
            ->groupBy('estados.nombre')
            ->get();

        return response()->json($tareasPorEstado, 200);
    }

    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'idEstado' => 'required|exists:estados,id'
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->idEstado = $request->idEstado;

        if ($tarea->idEstado == 4) {
            // Si el estado es ocupado descartar la tarea
            $tarea->observaciones = 'Esta tarea está en impedimento';
        } else {
            $tarea->observaciones = null;
        }

        $tarea->save();

        return response()->json($tarea, 200);
    }

    public function reasignar(Request $request, $id)
    {
        $request->validate([
            'idEmpleado' => 'required|exists:empleados,id'
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->idEmpleado = $request->idEmpleado;
        $tarea->save();

        return response()->json($tarea, 200);
    }
}
