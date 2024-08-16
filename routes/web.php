<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\publicar;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ExcelMergeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/csv', function () {
//     return view ('csv');
// });
// Route::get('csv', [TestController::class, 'export']);
// Route::post('csv/importar', [TestController::class, 'importar']);

//Route::delete('/files/{id}', 'TestController@destroy')->name('files.destroy');

//Route::post('/upload', [ExcelMergeController::class, 'uploadFiles'])->name('uploadFiles');


Route::get('/files', [TestController::class, 'listFiles'])->name('files.list');

Route::get('/files/{id}', [TestController::class, 'show'])->name('files.show');
Route::post('/files/export/{id}', [TestController::class, 'export'])->name('files.export');

Route::post('/files/export/{id}', [TestController::class, 'export'])->name('files.export');

Route::post('/upim', [ExcelMergeController::class, 'uploadAndImport'])->name('uploadAndImport');

Route::get('/download', [ExcelMergeController::class, 'downloadFile'])->name('downloadFile');

Route::get('/upload', [ExcelMergeController::class, 'showUploadForm']);
Route::post('/upload', [ExcelMergeController::class, 'uploadFiles'])->name('upload');

Route::get('/files/{id}', [TestController::class, 'showFile'])->name('files.show');

Route::get('files/showCombined', [TestController::class, 'showCombined'])->name('files.showCombined');

Route::get('crearcsv', function () {
    return view('crearcsv');
});

Route::get('/files/{id}/search', [TestController::class, 'search'])->name('files.search');
Route::get('/searchfile', [TestController::class, 'searchfile'])->name('searchfile');

Route::delete('/files/{id}', [TestController::class, 'destroy'])->name('files.destroy');

Route::get('/importar', [TestController::class, 'importar'])->name('importar');
Route::post('/importar', [TestController::class, 'importar'])->name('importar.post');

Route::get('/importar2', [TestController::class, 'importar2'])->name('importar2');
Route::post('/importar2', [TestController::class, 'importar2'])->name('importar2.post');

Route::get('/files', [TestController::class, 'listFiles'])->name('files.list');
Route::get('/files/{id}', [TestController::class, 'showFile'])->name('files.show');

Route::get('csv', [TestController::class, 'index'])->name('index');
Route::get('/importar', [TestController::class, 'create'])->name('create');
Route::post('/importar', [TestController::class, 'importar'])->name('importar');
Route::post('/importar', [TestController::class, 'importar'])->name('importar.post');

Route::get('/exportar', [TestController::class, 'exportar'])->name('exportar');

Route::post('/exportar', [TestController::class, 'exportar'])->name('exportar');

Route::get('/buscar', [TestController::class, 'search'])->name('search');

Route::get('/import', [TestController::class, 'import']);

Route::get('/crear', [TestController::class, 'import']);



Route::get('/curps', function () {
    $curp = 'GARO020603HZSRNMA0';
    $name = '';
    
    $controller = new TestController();
    $userId = $controller->getUserIdByCurp($curp, $name);
    
    return "ID : " . $userId ;
    "Nombre" . $name;
    return "Nombre : " . $name;
});

Route::get('/', function () {
    return view('/index');
});

Route::get('excel/upload', function () {
    return view('SANE_B.excel.upload');
})->name('excel.upload.form');
//Route::get('/import', 'TestController@import');

// Route::get('/import', function () {
//     return view('abc');
// });


