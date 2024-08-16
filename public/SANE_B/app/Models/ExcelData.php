<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelData extends Model
{
    use HasFactory;

    protected $fillable = [
        'ciclo_escolar',
        'ef',
        'curp',
        'cve_plaza_inicio',
        'tipo_plaza',
        'num_horas',
        'asignatura',
        'nivel_servicio',
        'tipo_valoracion',
        'tipo_examen',
        'puntuacion_global',
        'posicion_ordenamiento',
        'incentivo_atp',
        'incentivo_pfi',
        'incentivo_cm',
        'incentivo_ph',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'funcion',
        'tipo_asignacion',
        'cve_plaza_promocion',
        'cve_categoria',
        'cct_promocion',
        'qna_inicio',
        'qna_termino',
        'caducidad_promocion',
        'codigo_nombramiento',
        'promocion',
        'observaciones',
        'fecha_alta',
        'batch_id',
    ];
    
    public function getNumHorasAttribute($value)
    {
        return $value === '00' ? '' : $value;
    }
    
}
