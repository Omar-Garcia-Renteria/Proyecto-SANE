<?php


namespace App\Http\Controllers;

use League\Csv\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\User; 
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ExcelController;
// use App\Http\Controllers\ImportedFile;
use App\Models\ImportedFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;

use League\Csv\Reader;

class TestController extends Controller 
{
    public function download($id)
    {
        // Lógica para descargar el archivo
        $file = ImportedFile::find($id);
    
        // Supongamos que quieres descargar el archivo original
        $filePath = storage_path('app/public/' . $file->file_path);
        return response()->download($filePath, $file->file_name);
    }

    public function export($id)
    {
        // Lógica para exportar el archivo
        // Por ejemplo, puedes encontrar el archivo por su ID y generar una respuesta de descarga
        $file = ImportedFile::find($id);
    
        // Supongamos que quieres exportar el archivo original
        $filePath = storage_path('app/public/' . $file->file_path);
        return response()->download($filePath, $file->file_name);
    }
    

    public function descargarArchivo($id)
    {
        $file = ImportedFile::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->file_path);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }

        return response()->download($filePath, $file->file_name);
    }

    public function search(Request $request) {
        $curp = $request->input('curp');
        $file = ImportedFile::findOrFail($request->id);
        $path = storage_path('app/public/' . $file->file_path);
    
        if (!file_exists($path)) {
            return view('search', ['error' => 'Archivo no encontrado.']);
        }
    
        $lines = file($path);
        if ($lines === false) {
            return view('search', ['error' => 'No se puede leer el archivo.']);
        }
    
        $utf8_lines = array_map('utf8_encode', $lines);
        $header = str_getcsv(array_shift($utf8_lines));
        $data = array_map('str_getcsv', $utf8_lines);
    
        $user = null;
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            if ($row['CURP'] == $curp) {
                $user = new \stdClass();
                $user->curp = isset($row['CURP']) ? $row['CURP'] : null; // Asigna el CURP o null si no existe
        $user->folio = isset($row['FOLIO']) ? $row['FOLIO'] : null;
        $user->ef = isset($row['EF']) ? $row['EF'] : null;
        $user->ciclo_escolar = isset($row['CICLO_ESCOLAR']) ? $row['CICLO_ESCOLAR'] : null;
        $user->nombres = isset($row['NOMBRE']) ? $row['NOMBRE'] : null;
        $user->primer_apellido = isset($row['PRIMER_APELLIDO']) ? $row['PRIMER_APELLIDO'] : null;
        $user->segundo_apellido = isset($row['SEGUNDO_APELLIDO']) ? $row['SEGUNDO_APELLIDO'] : null;
        $user->cve_entidad = isset($row['CVE_ENTIDAD']) ? $row['CVE_ENTIDAD'] : null;
        $user->qna_inicio = isset($row['QNA_INICIO']) ? $row['QNA_INICIO'] : null;
        $user->cve_plaza_inicio = isset($row['CVE_PLAZA_INICIO']) ? $row['CVE_PLAZA_INICIO'] : null;
        $user->tipo_plaza = isset($row['TIPO_PLAZA']) ? $row['TIPO_PLAZA'] : null;
        $user->num_horas = isset($row['NUM_HORAS']) ? $row['NUM_HORAS'] : null;
        $user->asignatura = isset($row['ASIGNATURA']) ? $row['ASIGNATURA'] : null;
        $user->nivel_servicio = isset($row['NIVEL_SERVICIO']) ? $row['NIVEL_SERVICIO'] : null;
        $user->tipo_valoracion = isset($row['TIPO_VALORACION']) ? $row['TIPO_VALORACION'] : null;
        $user->tipo_examen = isset($row['TIPO_EXAMEN']) ? $row['TIPO_EXAMEN'] : null;
        $user->puntuacion_global = isset($row['PUNTUACION_GLOBAL']) ? $row['PUNTUACION_GLOBAL'] : null;
        $user->posicion_ordenamiento = isset($row['POSICION_ORDENAMIENTO']) ? $row['POSICION_ORDENAMIENTO'] : null;
        $user->incentivo_ATP = isset($row['INCENTIVO_ATP']) ? $row['INCENTIVO_ATP'] : null;
        $user->incentivo_PFI = isset($row['INCENTIVO_PFI']) ? $row['INCENTIVO_PFI'] : null;
        $user->incentivo_CM = isset($row['INCENTIVO_CM']) ? $row['INCENTIVO_CM'] : null;
        $user->incentivo_PH = isset($row['INCENTIVO_PH']) ? $row['INCENTIVO_PH'] : null;
        $user->funcion = isset($row['FUNCION']) ? $row['FUNCION'] : null;
        $user->tipo_asignacion = isset($row['TIPO_ASIGNACION']) ? $row['TIPO_ASIGNACION'] : null;
        $user->cve_plaza_promo = isset($row['CVE_PLAZA_PROMOCION']) ? $row['CVE_PLAZA_PROMOCION'] : null;
        $user->cve_categoria = isset($row['CVE_CATEGORIA']) ? $row['CVE_CATEGORIA'] : null;
        $user->cct_promocion = isset($row['CCT_PROMOCION']) ? $row['CCT_PROMOCION'] : null;
        $user->qna_termino = isset($row['QNA_TERMINO']) ? $row['QNA_TERMINO'] : null;
        $user->caducidad_promocion = isset($row['CADUCIDAD_PROMOCION']) ? $row['CADUCIDAD_PROMOCION'] : null;
        $user->codigo_nombramiento = isset($row['CODIGO_NOMBRAMIENTO']) ? $row['CODIGO_NOMBRAMIENTO'] : null;
        $user->promocion = isset($row['PROMOCION']) ? $row['PROMOCION'] : null;
        $user->observaciones = isset($row['OBSERVACIONES']) ? $row['OBSERVACIONES'] : null;
        $user->operacion = isset($row['OPERACION']) ? $row['OPERACION'] : null;
        $user->motivo_baja = isset($row['MOTIVO_BAJA']) ? $row['MOTIVO_BAJA'] : null;
        $users[] = $user;
                break;
            }
        }
    
        if ($user) {
            if ($request->has('exportar')) {
                $csvWriter = Writer::createFromPath(storage_path('app/public/search_results.csv'), 'w+');
                $csvWriter->insertOne(['CURP', 'Folio','EF', 'Nombres', 'Primer Apellido', 'Segundo Apellido', 'CVE Entidad', 'QNA Inicio', 'CVE Plaza Inicio', 'Tipo Plaza', 'Num Horas', 'Asignatura', 'Nivel Servicio', 'Tipo Valoración', 'Tipo Examen', 'Puntuación Global', 'Posición Ordenamiento', 'Incentivo ATP', 'Incentivo PFI', 'Incentivo CM', 'Incentivo PH', 'Función', 'Tipo Asignación', 'CVE Plaza Promoción', 'CVE Categoría', 'CCT Promoción', 'QNA Termino', 'Caducidad Promoción', 'Código Nombramiento', 'Promoción', 'Observaciones']);
                $csvWriter->insertOne([$user->curp, $user->folio,$user->ef, $user->nombres, $user->primer_apellido, $user->segundo_apellido, $user->cve_entidad, $user->qna_inicio, $user->cve_plaza_inicio, $user->tipo_plaza, $user->num_horas, $user->asignatura, $user->nivel_servicio, $user->tipo_valoracion, $user->tipo_examen, $user->puntuacion_global, $user->posicion_ordenamiento, $user->icentivo_ATP, $user->icentivo_PFI, $user->icentivo_CM, $user->icentivo_PH, $user->funcion, $user->tipo_asignacion, $user->cve_plaza_promo, $user->cve_categoria, $user->cct_promocion, $user->qna_termino, $user->caducidad_promocion, $user->codigo_nombramiento, $user->promocion, $user->observaciones]);
                return redirect()->back()->with('success', 'Datos exportados correctamente.');
            }
            
            return view('search', ['user' => $user]);
        } else {
            return view('search', ['error' => 'No se encontró el usuario con el CURP proporcionado.']);
        }
    }

    public function index(){
        $user = User::all();
        return view('csv', compact('user'));
    }

    public function importar2(Request $request)
    {
        $request->validate([
            'document_csv' => 'required|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('document_csv');
            $fileName = $file->getClientOriginalName(); //time() . '_' .
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $importedFile = new ImportedFile();
            $importedFile->file_name = $fileName;
            $importedFile->file_path = $filePath;
            $importedFile->save();

            Excel::import(new ExcelImport, $file);

            return redirect()->route('files.list')->with('success', 'Archivo agregado correctamente.');
            
        } catch (\Exception $e) {
            return redirect()->route('files.list')->with(['message' => 'Error al importar el archivo: ' . $e->getMessage()]);
            // return redirect()->back()->withErrors(['message' => 'Error al importar el archivo: ' . $e->getMessage()]);
        }
        
    }

    public function importar(Request $request)
    {
        $request->validate([
            'document_csv' => 'required|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('document_csv');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');




            // Guardar los detalles del archivo en la base de datos
            $importedFile = new ImportedFile();
            $importedFile->file_name = $fileName;
            $importedFile->file_path = $filePath;
            $importedFile->save();

            // Importar el archivo
            Excel::import(new ExcelImport, $file);

            return redirect()->route('files.list')->with('success', 'Archivo eliminado correctamente.');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Error al importar el archivo: ' . $e->getMessage()]);
        }
    }

    public function listFiles()
    {
        $files = ImportedFile::all();
        // return view('list_files', compact('files')

        $searchData = null;
    return view('list_files', compact('files', 'searchData'));
    }

            
    public function showFile($id) {
        $file = ImportedFile::findOrFail($id);
        $path = storage_path('app/public/' . $file->file_path);
    
        if (!file_exists($path)) {
            return response()->json(['error' => 'Archivo no encontrado.'], 404);
        }
    
        try {
            $lines = file($path);
            if ($lines === false) {
                return response()->json(['error' => 'No se puede leer el archivo.'], 500);
            }
    
            $utf8_lines = array_map('utf8_encode', $lines);
            $header = str_getcsv(array_shift($utf8_lines));
            $data = array_map('str_getcsv', $utf8_lines);
    
            $users = [];
            foreach ($data as $row) {
                $row = array_combine($header, $row);
                $user = new \stdClass();
                $user->curp = isset($row['CURP']) ? $row['CURP'] : null; // Asigna el CURP o null si no existe
        $user->folio = isset($row['FOLIO']) ? $row['FOLIO'] : null;
        $user->ciclo_escolar = isset($row['CICLO_ESCOLAR']) ? $row['CICLO_ESCOLAR'] : null;
        $user->nombres = isset($row['NOMBRE']) ? $row['NOMBRE'] : null;
        $user->primer_apellido = isset($row['PRIMER_APELLIDO']) ? $row['PRIMER_APELLIDO'] : null;
        $user->segundo_apellido = isset($row['SEGUNDO_APELLIDO']) ? $row['SEGUNDO_APELLIDO'] : null;
        $user->cve_entidad = isset($row['CVE_ENTIDAD']) ? $row['CVE_ENTIDAD'] : null;
        $user->qna_inicio = isset($row['QNA_INICIO']) ? $row['QNA_INICIO'] : null;
        $user->cve_plaza_inicio = isset($row['CVE_PLAZA_INICIO']) ? $row['CVE_PLAZA_INICIO'] : null;
        $user->tipo_plaza = isset($row['TIPO_PLAZA']) ? $row['TIPO_PLAZA'] : null;
        $user->num_horas = isset($row['NUM_HORAS']) ? $row['NUM_HORAS'] : null;
        $user->asignatura = isset($row['ASIGNATURA']) ? $row['ASIGNATURA'] : null;
        $user->nivel_servicio = isset($row['NIVEL_SERVICIO']) ? $row['NIVEL_SERVICIO'] : null;
        $user->tipo_valoracion = isset($row['TIPO_VALORACION']) ? $row['TIPO_VALORACION'] : null;
        $user->tipo_examen = isset($row['TIPO_EXAMEN']) ? $row['TIPO_EXAMEN'] : null;
        $user->puntuacion_global = isset($row['PUNTUACION_GLOBAL']) ? $row['PUNTUACION_GLOBAL'] : null;
        $user->posicion_ordenamiento = isset($row['POSICION_ORDENAMIENTO']) ? $row['POSICION_ORDENAMIENTO'] : null;
        $user->incentivo_ATP = isset($row['INCENTIVO_ATP']) ? $row['INCENTIVO_ATP'] : null;
        $user->incentivo_PFI = isset($row['INCENTIVO_PFI']) ? $row['INCENTIVO_PFI'] : null;
        $user->incentivo_CM = isset($row['INCENTIVO_CM']) ? $row['INCENTIVO_CM'] : null;
        $user->incentivo_PH = isset($row['INCENTIVO_PH']) ? $row['INCENTIVO_PH'] : null;
        $user->funcion = isset($row['FUNCION']) ? $row['FUNCION'] : null;
        $user->tipo_asignacion = isset($row['TIPO_ASIGNACION']) ? $row['TIPO_ASIGNACION'] : null;
        $user->cve_plaza_promo = isset($row['CVE_PLAZA_PROMOCION']) ? $row['CVE_PLAZA_PROMOCION'] : null;
        $user->cve_categoria = isset($row['CVE_CATEGORIA']) ? $row['CVE_CATEGORIA'] : null;
        $user->cct_promocion = isset($row['CCT_PROMOCION']) ? $row['CCT_PROMOCION'] : null;
        $user->qna_termino = isset($row['QNA_TERMINO']) ? $row['QNA_TERMINO'] : null;
        $user->caducidad_promocion = isset($row['CADUCIDAD_PROMOCION']) ? $row['CADUCIDAD_PROMOCION'] : null;
        $user->codigo_nombramiento = isset($row['CODIGO_NOMBRAMIENTO']) ? $row['CODIGO_NOMBRAMIENTO'] : null;
        $user->promocion = isset($row['PROMOCION']) ? $row['PROMOCION'] : null;
        $user->observaciones = isset($row['OBSERVACIONES']) ? $row['OBSERVACIONES'] : null;
        $user->fecha_alta = isset($row['FECHA_ALTA']) ? $row['FECHA_ALTA'] : null;
        $user->operacion = isset($row['OPERACION']) ? $row['OPERACION'] : null;
        $user->ef = isset($row['EF']) ? $row['EF'] : null;
        $user->motivo_baja = isset($row['MOTIVO_BAJA']) ? $row['MOTIVO_BAJA'] : null;
        $users[] = $user;
        
    
    }
    
    return view('curps', ['users' => $users]);
    // return response()->json(['users' => $users]);
} catch (\Exception $e) {
    return response()->json(['error' => 'Ocurrió un error al procesar el archivo.'], 500);
}
}


    public function getUserIdByCurp( $curp,$qna_inicio,$cve_entidad,$folio,$ef,$cve_plaza_inicio,$tipo_plaza,
    $num_horas,$asignatura,$nivel_servicio,$tipo_valoracion,$tipo_examen,$puntuacion_global,
    $posicion_ordenamiento,$icentivo_ATP,$icentivo_PFI,$icentivo_CM,$icentivo_PH,
    $nombres,$primer_apellido,$segundo_apellido,$funcion,$tipo_asignacion,
    $cve_plaza_promo,$cve_categoria,$cct_promocion,$qna_termino,
    $caducidad_promocion,$codigo_nombramiento,$promocion,$motivo_baja,$observaciones)
    {
        $user = User::where('', $curpIndexFile1)->first();
        if ($user) {
            return $user->id;
        }

        $user = new User();

        $user->curp = $curpIndexFile1;        
        $user->folio=$folioIndexFile1;
        $user->ef=$ef;
        $user->nombres=$nombresIndexFile1;
        $user->primer_apellido=$primer_apellidoIndexFile1;
        $user->segundo_apellido=$segundo_apellidoIndexFile1;
        $user->cve_entidad=$cve_entidadIndexFile1;
        $user->qna_inicio=$qna_inicioIndexFile2;
        $user->cve_plaza=$cve_plaza_inicioIndexFile2;
        $user->tipo_plaza=$tipo_plazaIndexFile2;
        $user->num_horas=$num_horasIndexFile2;
        $user->asignatura=$asignaturaIndexFile2;
        $user->nivel_servicio=$nivel_servicioIndexFile2;
        $user->tipo_valoracion=$tipo_valoracionIndexFile1;
        $user->tipo_examen=$tipo_examenIndexFile2;
        $user->puntuacion_global=$puntuacion_globalIndexFile2;
        $user->posicion_ordenamiento=$posicion_ordenamientoIndexFile1;
        $user->incentivo_ATP=$icentivo_ATPIndexFile1;
        $user->Incentivo_PFI=$icentivo_PFIIndexFile1;
        $user->incentivo_CM=$icentivo_CMIndexFile1;
        $user->incentivo_PH=$icentivo_PHIndexFile1;
        $user->funcion=$funcionIndexFile1;
        $user->tipo_asignacion=$tipo_asignacionIndexFile2;
        $user->cve_plaza_promo=$cve_plaza_promoIndexFile2;
        $user->cve_categoria=$cve_categoriaIndexFile2;
        $user->cct_promocion=$cct_promocionIndexFile2;
        $user->qna_termino=$qna_terminoIndexFile2;
        $user->caducidad_promocion=$caducidad_promocionIndexFile2;
        $user->codigo_nombramiento=$codigo_nombramientoIndexFile2;
        $user->promocion=$promocionIndexFile2;
        $user->motivo_baja=$motivo_bajaIndexFile2;
        $user->observaciones=$observacionesIndexFile2;
           
        $user->save();

        return $user->id;
    }


    public function exportar(Request $request) {
        $curp = $request->input('curp');
        $name = $request->input('name');
        $primer_apellido = $request->input('primer_apellido');
        $segundo_apellido = $request->input('segundo_apellido');
        $folio = $request->input('folio');
        $ef = $request->input('ef');
        $cve_entidad = $request->input('cve_entidad');
        $qna_inicio = $request->input('qna_inicio');
        $cve_plaza_inicio = $request->input('cve_plaza_inicio');
        $tipo_plaza = $request->input('tipo_plaza');
        $num_horas = $request->input('num_horas');
        $asignatura = $request->input('asignatura');
        $nivel_servicio = $request->input('nivel_servicio');
        $tipo_valoracion = $request->input('tipo_valoracion');
        $tipo_examen = $request->input('tipo_examen');
        $puntuacion_global = $request->input('puntuacion_global');
        $posicion_ordenamiento = $request->input('posicion ordenamiento');
        $incentivo_atp = $request->input('incentivo_atp');
        $incentivo_pfi = $request->input('incentivo_pfi');
        $incentivo_cm = $request->input('incentivo_cm');
        $incentivo_ph = $request->input('incentivo_ph');
        $funcion = $request->input('funcion');
        $tipo_asignacion = $request->input('tipo_asignacion');
        $cve_plaza_promo = $request->input('cve_plaza_promo');
        $cve_categoria = $request->input('cve_categoria');
        $cct_promocion = $request->input('cct_promocion');
        $qna_termino = $request->input('qna_termino');
        $caducidad_promocion = $request->input('caducidad_promocion');
        $codigo_nombramiento = $request->input('codigo_nombramiento');
        $promocion = $request->input('promocion');
        $motivo_baja = $request->input('motivo_baja');
        $observaciones = $request->input('observaciones');
    
        $csvWriter = Writer::createFromFileObject(new \SplTempFileObject());
        $csvWriter->insertOne(['CURP', 'NOMBRE(S)', 'PRIMER APELLIDO', 'SEGUNDO APELLIDO', 'FOLIO','EF','CVE_ENTIDAD','QNA_INICIO', 'CVE_PLAZA_INICIO', 'TIPO_PLAZA','NUM HORAS','ASIGNATURA','NIVEL_SERVICIO','TIPO_VALORACION','TIPO_EXAMEN', 'PUNTUACION_GLOBAL', 'POSICION_ORDENAMIENTO', 'INCENTIVO_ATP', 'INCENTIVO_PFI','INCENTIVO_CM','INCENTIVO_PH','FUNCION','TIPO_ASIGNACION','CVE_PLAZA_PROMO', 'CVE_CATEGORIA','CCT_PROMOCION', 'QNA_TERMINO', 'CADUCIDAD_PROMOCION', 'CODIGO_NOMBRAMIENTO', 'PROMOCION', 'MOTIVO_BAJA', 'OBSERVACIONES']);
        $csvWriter->insertOne([$curp, $name, $primer_apellido, $segundo_apellido, $folio, $ef,  $cve_entidad,$qna_inicio,$cve_plaza_inicio, $tipo_plaza,$num_horas,$asignatura,$nivel_servicio,$tipo_valoracion,$tipo_examen,$puntuacion_global,$posicion_ordenamiento,$incentivo_atp,$incentivo_pfi,$incentivo_cm,$incentivo_ph,$funcion,$tipo_asignacion,$cve_plaza_promo,$cve_categoria,$cct_promocion,$qna_termino,$caducidad_promocion,$codigo_nombramiento,$promocion,$motivo_baja,$observaciones]);
    
        // Descargar el archivo CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="search_results.csv"',
        ];
    
        return response()->stream(function () use ($csvWriter) {
            $csvWriter->output();
        }, 200, $headers);
    }


    public function destroy($id)
{
    $file = ImportedFile::findOrFail($id);
    
    $path = storage_path('app/public/' . $file->file_path);

    if (file_exists($path)) {
        unlink($path);  
    }

    $file->delete();
    // return redirect()->route('files.list')->with('success', 'Archivo eliminado correctamente.');
    return back()->with('danger', 'Archivo eliminado correctamente...');

    
    // return response()->json([
    //     'message' => 'Eliminado correctamente'
    // ]);
}

public function showData()
{
    $users = $this->showFile();

    return view('curps', ['users' => $users]);
}

public function searchfile(Request $request) {
    // Obtener el nombre del archivo desde la solicitud
    $fileName = $request->input('filename');

    // Buscar archivos basados en el nombre en la base de datos
    $files = ImportedFile::where('file_name', 'LIKE', "%{$fileName}%")->get();

    // Verificar si no se encontraron archivos en la base de datos
    if ($files->isEmpty()) {
        return view('list_files', ['files' => [], 'error' => 'Archivo no encontrado en la base de datos.']);
    }

    // Devolver la vista con los archivos encontrados
    return view('list_files', ['files' => $files]);
}

public function store()
{
    notify()->success('Laravel Notify is awesome!');

    return Redirect::home();
}

}