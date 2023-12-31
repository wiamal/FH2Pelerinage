<?php


use App\Models\Adherent;
use App\Models\Pelerinage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\PdfController;

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



Auth::routes();

Route::get('/confirm/{id}/{token}', '\App\Http\Controllers\Auth\RegisterController@confirm');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

    // Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::get('/', function () {
    //     return view('accueilPelerinage');
    // });

    Route::group([
        "prefix" => "dashboard",
        'as' => 'dashboard.'
    ], function () {
        Route::get('/profil', [App\Http\Controllers\AdherentController::class, 'index'])->name('profil');
        Route::get('/profil/edit', [App\Http\Controllers\AdherentController::class, 'edit'])->name('profil.edit');
        Route::get('/profil/beneficiaire', [App\Http\Controllers\AdherentController::class, 'viewBeneficiaires'])->name('profil.beneficiaire');
        Route::PUT('/profil/edit/{id}', [App\Http\Controllers\AdherentController::class, 'update'])->name('profil.updateAdherent');
        Route::get('/profil/Password', [App\Http\Controllers\AccountSetting::class, 'editPassword'])->name('profil.Password');
        Route::PUT('/profil/changePassword', [App\Http\Controllers\AccountSetting::class, 'changePassword'])->name('profil.changePassword');
    });


    // Pelerinage Routes
    Route::get('/pelerinage',  function () {
        return view('accueilPelerinage');
    })->name('accueilPelerinage');

    Route::view('pelerinage/inscription', 'inscriptionPelerinage')->name('inscriptionPelerinage');
    Route::view('pelerinage/liste-inscrits', 'listeInscritsPelerinage')->name('liste-inscrits');


    // Route::post('/demande',  [App\Http\Controllers\inscriptionPelerinageController::class, 'demander'])->name('demandePelerinage');

    //for displaying PDF
    Route::get('/pelerinage/pdf', [PdfController::class, 'show'])->name('pdf.show');
    // Route::get('/export-liste-inscrits', [\App\Http\Livewire\Pelerinage\ListeInscrits::class, 'exportToExcel'])->name('export-liste-inscrits');
});
