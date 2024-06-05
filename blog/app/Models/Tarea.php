<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'titulo', 
        'descripcion', 
        'fechaEstimadaFinalizacion', 
        'fechaFinalizacion', 
        'creadorTarea', 
        'observaciones', 
        'idEmpleado', 
        'idEstado', 
        'idPrioridad'
    ];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
