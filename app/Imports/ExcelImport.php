<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'operacion' => 'A',
            'ciclo' => $row[39],
            'cve_entidad' => $row[38],
            'curp' => $row[0],
            'folio' => $row[1],
            'cve_plaza_inicio' => $row[21],
            'tipo_plaza' => $row[37],
            'num_horas' => $row[36],
            'asignatura' => $row[35],
            'nivel_servicio' => $row[34],
            'tipo_valoracion' => $row[33],
            'tipo_examen' => $row[32],
            'puntuacion_global' => $row[31],
            'posicion_ordenamiento' => $row[28],
            'incentivo_ATP' => $row[30],
            'incentivo_PFI' => $row[29],
            'incentivo_CM' => $row[28],
            'incentivo_PH' => $row[27],
            'nombres' => $row[2],
            'primer_apellido' => $row[3],
            'segundo_apellido' => $row[4],
            'funcion' => $row[10],
            'tipo_asignacion' => $row[26],
            'cve_plaza_promocion' => $row[25],
            'cve_categoria' => $row[24],
            'cct_promocion' => $row[23],
            'qna_inicio' => $row[22],
            'qna_termino' => $row[21],
            'caducidad_promocion' => $row[20],
            'codigo_nombramiento' => $row[19],
            'promocion' => $row[18],
            'motivo_baja' => $row[17],
            'observaciones' => $row[19],
            'ef' => $row[33],
        ]);
    }
}