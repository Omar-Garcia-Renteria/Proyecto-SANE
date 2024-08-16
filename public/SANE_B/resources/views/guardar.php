<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ExcelData;
use Carbon\Carbon;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '600');

        $file = $request->file('excel_file');

        if ($file) {
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename);

            $spreadsheet = IOFactory::load(storage_path('app/' . $filePath));
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            foreach ($data as $index => $row) {
                if ($index === 0) {
                    continue;
                }

                $cvePlazaInicioArray = explode(',', $row[3]);

                foreach ($cvePlazaInicioArray as $cvePlazaInicio) {
                    $existingRecord = ExcelData::where('cve_plaza_inicio', trim($cvePlazaInicio))->first();

                    if (!$existingRecord) {
                        $caducidad_promocion = $this->transformDate($row[26]);
                        $fecha_alta = $this->transformDate($row[30]);

                        // Extract the two digits before the decimal point in CVE_PLAZA_INICIO
                        $num_horas = null;
                        if (preg_match('/(\d{2})\.\d+$/', $cvePlazaInicio, $matches)) {
                            $num_horas = str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                        } else {
                            $num_horas = null; 
                        }

                        $puntuacion_global = is_numeric($row[10]) ? $row[10] : null;
                        $posicion_ordenamiento = is_numeric($row[11]) ? $row[11] : null;

                        $qna_inicio = $this->transformQnaDate($row[24]);
                        $qna_termino = $this->transformQnaDate($row[25]);

                        ExcelData::create([
                            'ciclo_escolar' => $row[0],
                            'ef' => $row[1],
                            'curp' => $row[2],
                            'cve_plaza_inicio' => trim($cvePlazaInicio),
                            'tipo_plaza' => $row[4],
                            'num_horas' => $num_horas,
                            'asignatura' => $row[6],
                            'nivel_servicio' => $row[7],
                            'tipo_valoracion' => $row[8],
                            'tipo_examen' => $row[9],
                            'puntuacion_global' => $puntuacion_global,
                            'posicion_ordenamiento' => $posicion_ordenamiento,
                            'incentivo_atp' => $row[12],
                            'incentivo_pfi' => $row[13],
                            'incentivo_cm' => $row[14],
                            'incentivo_ph' => $row[15],
                            'nombre' => $row[16],
                            'primer_apellido' => $row[17],
                            'segundo_apellido' => $row[18],
                            'funcion' => $row[19],
                            'tipo_asignacion' => $row[20],
                            'cve_plaza_promocion' => $row[21],
                            'cve_categoria' => $row[22],
                            'cct_promocion' => $row[23],
                            'qna_inicio' => $qna_inicio,
                            'qna_termino' => $qna_termino,
                            'caducidad_promocion' => $caducidad_promocion,
                            'codigo_nombramiento' => $row[27],
                            'promocion' => $row[28],
                            'observaciones' => $row[29],
                            'fecha_alta' => $fecha_alta,
                        ]);
                    }
                }
            }

            return redirect()->route('excel.index');
        } else {
            return back()->with('error', 'Por favor, seleccione un archivo.');
        }
    }

    private function transformDate($date)
    {
        if ($date) {
            $date = str_replace('/', '-', $date);
            try {
                return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }

    private function transformQnaDate($qna)
    {
        if ($qna) {
            $quincenas = [
                '01' => ['start' => '01-01-2024', 'end' => '15-01-2024'],
                '02' => ['start' => '16-01-2024', 'end' => '31-01-2024'],
                '03' => ['start' => '01-02-2024', 'end' => '15-02-2024'],
                '04' => ['start' => '16-02-2024', 'end' => '29-02-2024'],
                '05' => ['start' => '01-03-2024', 'end' => '15-03-2024'],
                '06' => ['start' => '16-03-2024', 'end' => '31-03-2024'],
                '07' => ['start' => '01-04-2024', 'end' => '15-04-2024'],
                '08' => ['start' => '16-04-2024', 'end' => '30-04-2024'],
                '09' => ['start' => '01-05-2024', 'end' => '15-05-2024'],
                '10' => ['start' => '16-05-2024', 'end' => '31-05-2024'],
                '11' => ['start' => '01-06-2024', 'end' => '15-06-2024'],
                '12' => ['start' => '16-06-2024', 'end' => '30-06-2024'],
                '13' => ['start' => '01-07-2024', 'end' => '15-07-2024'],
                '14' => ['start' => '16-07-2024', 'end' => '31-07-2024'],
                '15' => ['start' => '01-08-2024', 'end' => '15-08-2024'],
                '16' => ['start' => '16-08-2024', 'end' => '31-08-2024'],
                '17' => ['start' => '01-09-2024', 'end' => '15-09-2024'],
                '18' => ['start' => '16-09-2024', 'end' => '30-09-2024'],
                '19' => ['start' => '01-10-2024', 'end' => '15-10-2024'],
                '20' => ['start' => '16-10-2024', 'end' => '31-10-2024'],
                '21' => ['start' => '01-11-2024', 'end' => '15-11-2024'],
                '22' => ['start' => '16-11-2024', 'end' => '30-11-2024'],
                '23' => ['start' => '01-12-2024', 'end' => '15-12-2024'],
                '24' => ['start' => '16-12-2024', 'end' => '31-12-2024'],
            ];

            $parts = explode('/', $qna);
            if (count($parts) == 2) {
                $qna_number = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
                if (array_key_exists($qna_number, $quincenas)) {
                    $start_date = Carbon::parse($quincenas[$qna_number]['start']);
                    $end_date = Carbon::parse($quincenas[$qna_number]['end']);

                    $today = Carbon::now();
                    if ($today->between($start_date, $end_date)) {
                        return $today->format('d-m-Y');
                    } else {
                        return $start_date->format('d-m-Y'); 
                    }
                }
            }
        }
        return null;
    }

    public function index()
    {
        $data = ExcelData::all();
        return view('excel.index', compact('data'));
    }
}
