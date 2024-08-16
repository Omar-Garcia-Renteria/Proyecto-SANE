<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;


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

Route::get('/', function () {
    return view('welcome');
});


Route::get('excel/upload', function () {
    return view('excel.upload');
})->name('excel.upload.form');

Route::post('excel/upload', [ExcelController::class, 'upload'])->name('excel.upload');
Route::get('excel/', [ExcelController::class, 'index'])->name('excel.index');

Route::get('/excel/download-csv', [ExcelController::class, 'downloadCsv'])->name('excel.downloadCsv');

Route::get('excel/search-results/{batchId}', [ExcelController::class, 'searchResults'])->name('excel.searchResults');

Route::get('excel/show/{batchId}', [ExcelController::class, 'show'])->name('excel.show');

