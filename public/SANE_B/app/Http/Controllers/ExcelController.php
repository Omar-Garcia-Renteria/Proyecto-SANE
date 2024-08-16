<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ExcelData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', '300');
    
        $file = $request->file('excel_file');
    
        if ($file) {
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $filename);

            $batchId = uniqid();
    
            $spreadsheet = IOFactory::load(storage_path('app/' . $filePath));
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
    
            foreach ($data as $index => $row) {
                if ($index === 0) {
                    continue;
                }
    
                $cvePlazaInicioArray = explode(',', $row[3]);
    
                foreach ($cvePlazaInicioArray as $cvePlazaInicio) {
                    $existingRecord = ExcelData::where('cve_plaza_inicio', trim($cvePlazaInicio))
                        ->where('batch_id', $batchId)
                        ->first();
                        
                    if (!$existingRecord) {
                        $caducidad_promocion = $this->transformDate($row[26]);
                        $fecha_alta = $this->transformDate($row[30]);
    
                        $num_horas = null;
                        if (preg_match('/(\d{2})\.\d+$/', $cvePlazaInicio, $matches)) {
                            $num_horas = ($matches[1] === '00') ? '' : str_pad($matches[1], 2, '0', STR_PAD_LEFT);
                        } else {
                            $num_horas = null;
                        }
                        
                        $puntuacion_global = is_numeric($row[10]) ? $row[10] : null;
                        $posicion_ordenamiento = is_numeric($row[11]) ? $row[11] : null;
    
                        $qna_inicio = $this->transformQnaDate($row[24]);
                        $qna_termino = $this->transformQnaDate($row[25]);
    
                        ExcelData::create([
                            'batch_id' => $batchId,
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
    
            return redirect()->route('excel.show', ['batchId' => $batchId]);
        } else {
            return back()->with('error', 'Por favor, Selecciona un Archivo.');
        }
    }

    public function show($batchId)
    {
        // Fetch data associated with the batchId
        $data = ExcelData::where('batch_id', $batchId)->get();
    
        // Handle the scenario where no data is found
        if ($data->isEmpty()) {
            return view('excel.show', ['data' => $data, 'batchId' => $batchId])->with('error', 'No data found for this batch.');
        }
    
        // Group the data (if needed)
        $groupedData = $data->groupBy(function ($item) {
            return $item->curp . '-' . $item->nombre . '-' . $item->primer_apellido . '-' . $item->segundo_apellido;
        });
    
        // Format the date fields
        $data = $data->map(function ($item) {
            $item->caducidad_promocion = $this->invertDateFormat($item->caducidad_promocion);
            $item->fecha_alta = $this->invertDateFormat($item->fecha_alta);
            return $item;
        });
    
        // Pass the data and batchId to the view
        return view('excel.show', compact('data', 'groupedData', 'batchId'));
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
    
    private function invertDateFormat($date)
    {
        if ($date) {
            try {
                return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }

    public function searchResults(Request $request, $batchId)
{
    $search = $request->input('search');

    // Filter data by batchId and search query
    $data = ExcelData::where('batch_id', $batchId)
        ->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('curp', 'like', "%{$search}%")
                    ->orWhere('nombre', 'like', "%{$search}%")
                    ->orWhere('primer_apellido', 'like', "%{$search}%")
                    ->orWhere('segundo_apellido', 'like', "%{$search}%");
            });
        })->get();

    if ($data->isEmpty()) {
        return view('excel.search_results', [
            'data' => $data,
            'batchId' => $batchId,  // Pass batchId to the view
        ])->with('error', 'No se encontraron resultados para la búsqueda: ' . $search);
    }

    $groupedData = $data->groupBy(function($item) {
        return $item->curp . '-' . $item->nombre . '-' . $item->primer_apellido . '-' . $item->segundo_apellido;
    });

    $data = $data->map(function($item) {
        $item->caducidad_promocion = $this->invertDateFormat($item->caducidad_promocion);
        $item->fecha_alta = $this->invertDateFormat($item->fecha_alta);
        return $item;
    });

    return view('excel.search_results', compact('data', 'groupedData', 'batchId'));
}

    
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $data = ExcelData::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('ciclo_escolar', 'like', "%{$search}%")
                    ->orWhere('ef', 'like', "%{$search}%")
                    ->orWhere('curp', 'like', "%{$search}%")
                    ->orWhere('cve_plaza_inicio', 'like', "%{$search}%")
                    ->orWhere('tipo_plaza', 'like', "%{$search}%")
                    ->orWhere('num_horas', 'like', "%{$search}%")
                    ->orWhere('asignatura', 'like', "%{$search}%")
                    ->orWhere('nivel_servicio', 'like', "%{$search}%")
                    ->orWhere('tipo_valoracion', 'like', "%{$search}%")
                    ->orWhere('tipo_examen', 'like', "%{$search}%")
                    ->orWhere('puntuacion_global', 'like', "%{$search}%")
                    ->orWhere('posicion_ordenamiento', 'like', "%{$search}%")
                    ->orWhere('incentivo_atp', 'like', "%{$search}%")
                    ->orWhere('incentivo_pfi', 'like', "%{$search}%")
                    ->orWhere('incentivo_cm', 'like', "%{$search}%")
                    ->orWhere('incentivo_ph', 'like', "%{$search}%")
                    ->orWhere('nombre', 'like', "%{$search}%")
                    ->orWhere('primer_apellido', 'like', "%{$search}%")
                    ->orWhere('segundo_apellido', 'like', "%{$search}%")
                    ->orWhere('funcion', 'like', "%{$search}%")
                    ->orWhere('tipo_asignacion', 'like', "%{$search}%")
                    ->orWhere('cve_plaza_promocion', 'like', "%{$search}%")
                    ->orWhere('cve_categoria', 'like', "%{$search}%")
                    ->orWhere('cct_promocion', 'like', "%{$search}%")
                    ->orWhere('qna_inicio', 'like', "%{$search}%")
                    ->orWhere('qna_termino', 'like', "%{$search}%")
                    ->orWhere('caducidad_promocion', 'like', "%{$search}%")
                    ->orWhere('codigo_nombramiento', 'like', "%{$search}%")
                    ->orWhere('promocion', 'like', "%{$search}%")
                    ->orWhere('observaciones', 'like', "%{$search}%")
                    ->orWhere('fecha_alta', 'like', "%{$search}%");
            });
        })->get();
    
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }
    
        
        if ($request->has('search') && ($search = $request->input('search'))) {
            $filteredData = $data->filter(function ($item) use ($search) {
                return stripos($item->curp, $search) !== false
                    || stripos($item->nombre, $search) !== false
                    || stripos($item->primer_apellido, $search) !== false
                    || stripos($item->segundo_apellido, $search) !== false;
            });
        
            if ($filteredData->isNotEmpty()) {
                $groupedData = $filteredData->groupBy(function($item) {
                    return $item->curp . '-' . $item->nombre . '-' . $item->primer_apellido . '-' . $item->segundo_apellido;
                });
        
                $filteredData = $filteredData->map(function($item) {
                    $item->caducidad_promocion = $this->invertDateFormat($item->caducidad_promocion);
                    $item->fecha_alta = $this->invertDateFormat($item->fecha_alta);
                    return $item;
                });
        
                return view('excel.search_results', ['data' => $filteredData, 'groupedData' => $groupedData]);
            }
        }
        
    
        $data = $data->map(function($item) {
            $item->caducidad_promocion = $this->invertDateFormat($item->caducidad_promocion);
            $item->fecha_alta = $this->invertDateFormat($item->fecha_alta);
            return $item;
        });
    
        return view('excel.index', compact('data'));
    }

    private function transformQnaDate($qna)
        {
            if ($qna) {
            
                $parts = explode('/', $qna);
                if (count($parts) == 2) {
                    $qna_number = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
                    $year = 2000 + intval($parts[1]);
        
                    
                    $quincenas = [
                        '01' => ['start' => "$year/01/01", 'end' => "$year/01/15"],
                        '02' => ['start' => "$year/01/16", 'end' => "$year/01/31"],
                        '03' => ['start' => "$year/02/01", 'end' => "$year/02/15"],
                        '04' => ['start' => "$year/02/16", 'end' => "$year/02/29"],
                        '05' => ['start' => "$year/03/01", 'end' => "$year/03/15"],
                        '06' => ['start' => "$year/03/16", 'end' => "$year/03/31"],
                        '07' => ['start' => "$year/04/01", 'end' => "$year/04/15"],
                        '08' => ['start' => "$year/04/16", 'end' => "$year/04/30"],
                        '09' => ['start' => "$year/05/01", 'end' => "$year/05/15"],
                        '10' => ['start' => "$year/05/16", 'end' => "$year/05/31"],
                        '11' => ['start' => "$year/06/01", 'end' => "$year/06/15"],
                        '12' => ['start' => "$year/06/16", 'end' => "$year/06/30"],
                        '13' => ['start' => "$year/07/01", 'end' => "$year/07/15"],
                        '14' => ['start' => "$year/07/16", 'end' => "$year/07/31"],
                        '15' => ['start' => "$year/08/01", 'end' => "$year/08/15"],
                        '16' => ['start' => "$year/08/16", 'end' => "$year/08/31"],
                        '17' => ['start' => "$year/09/01", 'end' => "$year/09/15"],
                        '18' => ['start' => "$year/09/16", 'end' => "$year/09/30"],
                        '19' => ['start' => "$year/10/01", 'end' => "$year/10/15"],
                        '20' => ['start' => "$year/10/16", 'end' => "$year/10/31"],
                        '21' => ['start' => "$year/11/01", 'end' => "$year/11/15"],
                        '22' => ['start' => "$year/11/16", 'end' => "$year/11/30"],
                        '23' => ['start' => "$year/12/01", 'end' => "$year/12/15"],
                        '24' => ['start' => "$year/12/16", 'end' => "$year/12/31"],
                    ];
        
                    if (array_key_exists($qna_number, $quincenas)) {
                        $start_date = Carbon::parse($quincenas[$qna_number]['start']);
                        $end_date = Carbon::parse($quincenas[$qna_number]['end']);
        
                        $today = Carbon::now();
                        if ($today->between($start_date, $end_date)) {
                            return $today->format('d/m/Y');
                        } else {
                            return $start_date->format('d/m/Y'); 
                        }
                    }
                }
            }
            return null;
        }

    public function downloadCsv()
{
    $data = ExcelData::all();

    $csvData = [];
    $csvData[] = [
        'CICLO_ESCOLAR', 'EF', 'CURP', 'CVE_PLAZA_INICIO', 'TIPO_PLAZA', 'NUM_HORAS',
        'ASIGNATURA', 'NIVEL_SERVICIO', 'TIPO_VALORACION', 'TIPO_EXAMEN', 'PUNTUACION_GLOBAL',
        'POSICION_ORDENAMIENTO', 'INCENTIVO_ATP', 'INCENTIVO_PFI', 'INCENTIVO_CM', 'INCENTIVO_PH',
        'NOMBRE', 'PRIMER_APELLIDO', 'SEGUNDO_APELLIDO', 'FUNCION', 'TIPO_ASIGNACION',
        'CVE_PLAZA_PROMOCION', 'CVE_CATEGORIA', 'CCT_PROMOCION', 'QNA_INICIO', 'QNA_TERMINO',
        'CADUCIDAD_PROMOCION', 'CODIGO_NOMBRAMIENTO', 'PROMOCION', 'OBSERVACIONES', 'FECHA_ALTA'
    ];

    foreach ($data as $row) {
        $csvData[] = [
            str_replace('.', '', $row->ciclo_escolar) ?: '',
            str_replace('/', '-', $row->ef) ?: '',
            str_replace('.', '', $row->curp) ?: '',
            str_replace('.', '', $row->cve_plaza_inicio) ?: '',
            str_replace('.', '', $row->tipo_plaza) ?: '',
            str_replace('.', '', $row->num_horas) ?: '',
            str_replace('.', '', $row->asignatura) ?: '',
            str_replace('.', '', $row->nivel_servicio) ?: '',
            str_replace('.', '', $row->tipo_valoracion) ?: '',
            str_replace('.', '', $row->tipo_examen) ?: '',
            str_replace('.', '', $row->puntuacion_global) ?: '',
            str_replace('.', '', $row->posicion_ordenamiento) ?: '',
            str_replace('.', '', $row->incentivo_atp) ?: '',
            str_replace('.', '', $row->incentivo_pfi) ?: '',
            str_replace('.', '', $row->incentivo_cm) ?: '',
            str_replace('.', '', $row->incentivo_ph) ?: '',
            str_replace('.', '', $row->nombre) ?: '',
            str_replace('.', '', $row->primer_apellido) ?: '',
            str_replace('.', '', $row->segundo_apellido) ?: '',
            str_replace('.', '', $row->funcion) ?: '',
            str_replace('.', '', $row->tipo_asignacion) ?: '',
            str_replace('.', '', $row->cve_plaza_promocion) ?: '',
            str_replace('.', '', $row->cve_categoria) ?: '',
            str_replace('.', '', $row->cct_promocion) ?: '',
            str_replace('-', '/', $row->qna_inicio) ?: '',
            str_replace('-', '/', $row->qna_termino) ?: '',
            $this->invertDate($row->caducidad_promocion) ?: '',
            str_replace('-', '/', $row->codigo_nombramiento) ?: '',
            str_replace('.', '', $row->promocion) ?: '',
            str_replace('.', '', $row->observaciones) ?: '',
            $this->invertDate($row->fecha_alta) ?: '',
        ];
    }

    $filename = "excel_data_" . date('Ymd_His') . ".csv";
    $file = fopen('php://memory', 'w');

    foreach ($csvData as $line) {
        $csvLine = implode(',', array_map(function($field) {
            return trim($field);
        }, $line));
        fwrite($file, $csvLine . PHP_EOL);
    }

    fseek($file, 0);

    foreach ($csvData as $line) {
        $csvLine = implode(',', array_map('trim', $line));
    $csvLine = preg_replace('/,{2,}/', ',,', $csvLine); 
        fwrite($file, $csvLine . PHP_EOL);
    }

    fseek($file, 0);

    return Response::stream(function() use ($file) {
        fpassthru($file);
    }, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '";',
    ]);
}

private function invertDate($date)
{
    if ($date) {
        try {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        } catch (\Exception $e) {
            return null;
        }
    }
    return null;
}


}