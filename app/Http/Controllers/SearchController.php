<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Http\Controllers\TestController;


class SearchController extends Controller
{
    public function search(Request $request) {
        $curp = $request->input('curp');

        $path = public_path('ejemplo2.csv');
        $lines = file($path);
        $utf8_lines = array_map('utf8_encode', $lines);
        $data = array_map('str_getcsv', $utf8_lines);

        $user = null;
        foreach ($data as $row) {
            if ($row[2] == $curp) {
                $user = new \stdClass();
                $user->curp = $row[2];
        $user->folio = $row[1];
        $user->nombres = $row[0];
        $user->ef = $row[1];
        $user->primer_apellido = $row[3];
        $user->segundo_apellido = $row[4];
        $user->cve_entidad = $row[5];
        $user->qna_inicio = $row[19];
        $user->cve_plaza_inicio= $row[22];
        $user->tipo_plaza= $row[37];
        $user->num_horas= $row[36];
        $user->asignatura = $row[35];
        $user->nivel_servicio = $row[34];
        $user->tipo_valoracion = $row[33];
        $user->tipo_examen = $row[32];
        $user->puntuacion_global = $row[31];
        $user->posicion_ordenamiento = $row[30];
        $user->icentivo_ATP = $row[29];
        $user->icentivo_PFI = $row[28];
        $user->icentivo_CM = $row[27];
        $user->icentivo_PH = $row[26];
        $user->funcion = $row[10];
        $user->tipo_asignacion = $row[25];
        $user->cve_plaza_promo = $row[24];
        $user->cve_categoria = $row[23];
        $user->cct_promocion = $row[22];
        $user->qna_termino = $row[20];
        $user->caducidad_promocion = $row[21];
        $user->codigo_nombramiento = $row[18];
        $user->promocion = $row[17];
        $user->motivo_baja= $row[16];
        $user->observaciones = $row[22];

                break;
            }
        }

        if ($user) {
            return view('search', ['user' => $user]);
        } else {
            return view('search', ['error' => 'Escriba la CURP del usuario para obtener su información.']);
        }

    }

    public function export(Request $request) {
        $user = new \stdClass();
        $user->curp = $request->input('curp');
        $user->name = $request->input('name');
        $user->prim_apell = $request->input('prim_apell');
        $user->seg_apell = $request->input('seg_apell');
        $user->email = $request->input('email');
        $user->id_ent = $request->input('id_ent');
        $user->numero = $request->input('numero');
    
        return $this->exportToCsv($user);
    }
    
    private function exportToCsv() {
        $csv = Writer::createFromFileObject(new SplTempFileObject());
    
        $csv->insertOne(['CURP', 'Folio','Nombres', 'Primer Apellido', 'Segundo Apellido', 'CVE Entidad',
            'QNA Inicio', 'CVE Plaza Inicio', 'Tipo Plaza', 'Num Horas', 'Asignatura', 'Nivel Servicio',
            'Tipo Valoración', 'Tipo Examen', 'Puntuación Global', 'Posición Ordenamiento',
            'Incentivo ATP', 'Incentivo PFI', 'Incentivo CM', 'Incentivo PH', 'Función', 'Tipo Asignación',
            'CVE Plaza Promoción', 'CVE Categoría', 'CCT Promoción', 'QNA Termino', 'Caducidad Promoción',
            'Código Nombramiento', 'Promoción', 'Motivo Baja', 'Observaciones']);
    
        $csv->insertOne([$user->curpIndexFile1, $user->folioIndexFile1, $user->nombresIndexFile1, $user->primer_apellidoIndexFile1, $user->segundo_apellidoIndexFile1,
        $user->cve_entidadIndexFile1, $user->qna_inicioIndexFile2, $user->cve_plaza_inicioIndexFile2, $user->tipo_plazaIndexFile2, $user->num_horasIndexFile2,
        $user->asignaturaIndexFile2, $user->nivel_servicioIndexFile2, $user->tipo_valoracionIndexFile1, $user->tipo_examenIndexFile2, $user->puntuacion_globalIndexFile2,
        $user->posicion_ordenamientoIndexFile1, $user->icentivo_ATPIndexFile1, $user->icentivo_PFIIndexFile1, $user->icentivo_CMIndexFile1, $user->icentivo_PHIndexFile1,
        $user->funcionIndexFile1, $user->tipo_asignacionIndexFile2, $user->cve_plaza_promoIndexFile2, $user->cve_categoriaIndexFile2, $user->cct_promocionIndexFile2,
        $user->qna_terminoIndexFile2, $user->caducidad_promocionIndexFile2, $user->codigo_nombramientoIndexFile2, $user->promocionIndexFile2, $user->motivo_bajaIndexFile2,
        $user->observacionesIndexFile2]);
    
        $filename = 'user_' . $user->curp . '.csv';
        return response((string) $csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}