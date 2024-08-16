<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ExcelMergeController extends Controller
{
    private function dateToQuincena($fecha)
    {
        if (empty($fecha)) {
            return null; // Retorna null si la fecha está vacía
        }

        // Convertir el número de Excel a una fecha
        if (is_numeric($fecha)) {
            $fecha = Date::excelToDateTimeObject($fecha)->format('d-m-Y');
        }
                    
        if (!strtotime($fecha)) {
            return null; 
        }
        $anio = date('y', strtotime($fecha));
        $mes = date('m', strtotime($fecha));
        $dia = date('d', strtotime($fecha));

        

        if ($dia <= 15) {
            $quincena = ($mes - 1) * 2 + 1;
        } else {
            $quincena = ($mes - 1) * 2 + 2;
        }

        // Formatear el resultado en el formato 'quincena/año'
        $qna = sprintf('%02d/%02d', $quincena, $anio);
        return $qna;
    }

    public function showUploadForm()
    {
        return view('upload');
    }

    public function downloadFile()
    {
        $file = public_path('file.csv');
        return Response::download($file, 'combined.csv');
        // ->redirect()->route('csv')->with('error', 'Archivo no combinado');
    }

    public function uploadFiles(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'file1' => 'required|file|mimes:xls,xlsx',
            'file2' => 'required|file|mimes:xls,xlsx',
            'filename' => 'required|string',
        ], [
            'file1.required' => 'El archivo 1 es requerido.',
            'file1.mimes' => 'El archivo 1 debe ser de tipo: xls, xlsx.',
            'file2.required' => 'El archivo 2 es requerido.',
            'file2.mimes' => 'El archivo 2 debe ser de tipo: xls, xlsx.',
            'filename.required' => 'El nombre del archivo es requerido.',
            'filename.string' => 'El nombre del archivo debe ser una cadena de texto.',
        ]);

        $file1 = $request->file('file1')->store('temp');
        $file2 = $request->file('file2')->store('temp');
        $filename = $request->input('filename');

        try {
            $spreadsheet1 = Excel::toArray([], storage_path('app/' . $file1))[0];
            $spreadsheet2 = Excel::toArray([], storage_path('app/' . $file2))[0];
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar los archivos Excel: ' . $e->getMessage()], 500);
        }

        $indices = [
            'curpIndexFile1' => 0,
            'curpIndexFile2' => 1,
            'qna_inicioIndexFile2' => 19,
            'cve_entidadIndexFile1' => 5,
            'folioIndexFile1' => 10,
            'cve_plaza_inicioIndexFile2' => 22,
            'tipo_plazaIndexFile2' => 37,
            'num_horasIndexFile2' => 36,
            'asignaturaIndexFile2' => 35,
            'nivel_servicioIndexFile2' => 34,
            'tipo_valoracionIndexFile1' => 33,
            'tipo_examenIndexFile2' => 32,
            'puntuacion_globalIndexFile2' => 31,
            'posicion_ordenamientoIndexFile1' => 30,
            'icentivo_ATPIndexFile1' => 29,
            'icentivo_PFIIndexFile1' => 28,
            'icentivo_CMIndexFile1' => 27,
            'icentivo_PHIndexFile1' => 26,
            'nombresIndexFile1' => 2,
            'primer_apellidoIndexFile1' => 3,
            'segundo_apellidoIndexFile1' => 4,
            'funcionIndexFile1' => 10,
            'tipo_asignacionIndexFile2' => 25,
            'cve_plaza_promoIndexFile2' => 24,
            'cve_categoriaIndexFile2' => 23,
            'cct_promocionIndexFile2' => 22,
            'qna_terminoIndexFile2' => 20,
            'caducidad_promocionIndexFile2' => 21,
            'codigo_nombramientoIndexFile2' => 18,
            'promocionIndexFile2' => 17,
            'motivo_bajaIndexFile2' => 16,
            'observacionesIndexFile2' => 22,
        ];

        $mergedData = [];

        foreach ($spreadsheet1 as $row1) {
            $curp = $row1[$indices['curpIndexFile1']] ?? null;
            if (!$curp) {
                continue; // Salta la fila si no tiene CURP
            }

            foreach ($spreadsheet2 as $row2) {
                if (($row2[$indices['curpIndexFile2']] ?? null) == $curp) {
                    $qna_inicio = $this->dateToQuincena($row2[$indices['qna_inicioIndexFile2']] ?? '');
                    $qna_termino = $this->dateToQuincena($row2[$indices['qna_terminoIndexFile2']] ?? '');

                    $mergedData[] = [
                        'A',
                        '2024-2025',
                        $row1[$indices['cve_entidadIndexFile1']] ?? '',
                        $curp,
                        $row1[$indices['folioIndexFile1']] ?? '',
                        $row2[$indices['cve_plaza_inicioIndexFile2']] ?? '',
                        $row2[$indices['tipo_plazaIndexFile2']] ?? '',
                        $row2[$indices['num_horasIndexFile2']] ?? '',
                        $row2[$indices['asignaturaIndexFile2']] ?? '',
                        $row2[$indices['nivel_servicioIndexFile2']] ?? '',
                        $row1[$indices['tipo_valoracionIndexFile1']] ?? '',
                        $row2[$indices['tipo_examenIndexFile2']] ?? '',
                        $row2[$indices['puntuacion_globalIndexFile2']] ?? '',
                        $row1[$indices['posicion_ordenamientoIndexFile1']] ?? '',
                        $row1[$indices['icentivo_ATPIndexFile1']] ?? '',
                        $row1[$indices['icentivo_PFIIndexFile1']] ?? '',
                        $row1[$indices['icentivo_CMIndexFile1']] ?? '',
                        $row1[$indices['icentivo_PHIndexFile1']] ?? '',
                        $row1[$indices['nombresIndexFile1']] ?? '',
                        $row1[$indices['primer_apellidoIndexFile1']] ?? '',
                        $row1[$indices['segundo_apellidoIndexFile1']] ?? '',
                        $row1[$indices['funcionIndexFile1']] ?? '',
                        $row2[$indices['tipo_asignacionIndexFile2']] ?? '',
                        $row2[$indices['cve_plaza_promoIndexFile2']] ?? '',
                        $row2[$indices['cve_categoriaIndexFile2']] ?? '',
                        $row2[$indices['cct_promocionIndexFile2']] ?? '',
                        $qna_inicio,
                        $qna_termino,
                        $row2[$indices['caducidad_promocionIndexFile2']] ?? '',
                        $row2[$indices['codigo_nombramientoIndexFile2']] ?? '',
                        $row2[$indices['promocionIndexFile2']] ?? '',
                        $row2[$indices['motivo_bajaIndexFile2']] ?? '',
                        $row2[$indices['observacionesIndexFile2']] ?? '',
                    ];

                    break;
                }
            }
        }

        if (empty($mergedData)) {
            return response()->json(['error' => 'No se encontraron coincidencias entre los archivos.'], 400);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray([
            'OPERACION', 'CICLO_ESCOLAR', 'CVE_ENTIDAD', 'CURP', 'FOLIO', 'CVE_PLAZA_INICIO', 'TIPO_PLAZA', 'NUM HORAS', 'ASIGNATURA', 'NIVEL_SERVICIO', 'TIPO_VALORACION', 'TIPO_EXAMEN', 'PUNTUACION_GLOBAL', 'POSICION_ORDENAMIENTO', 'INCENTIVO_ATP', 'INCENTIVO_PFI',
            'INCENTIVO_CM', 'INCENTIVO_PH', 'NOMBRE(S)', 'PRIMER_APELLIDO', 'SEGUNDO_APELLIDO', 'FUNCION', 'TIPO_ASIGNACION', 'CVE_PLAZA_PROMOCION', 'CVE_CATEGORIA', 'CCT_PROMOCION', 'QNA_INICIO',
            'QNA_TERMINO', 'CADUCIDAD_PROMOCION', 'CODIGO_NOMBRAMIENTO', 'PROMOCION', 'MOTIVO_BAJA', 'OBSERVACIONES'
        ], NULL, 'A1');

        $sheet->fromArray($mergedData, NULL, 'A2');

        $writer = new Csv($spreadsheet);
        $writer->setEnclosure(''); // Establecer delimitador vacío para evitar comillas
        $mergedFilePath = storage_path('app/temp/combined.csv');
        $writer->save($mergedFilePath);

        return response()->download($mergedFilePath, $filename . '.csv')->deleteFileAfterSend(true);
        return view('csv');
        // return redirect()->route('csv')-> with('error', 'archivo no generado');
}
}