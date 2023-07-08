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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/confirm/{id}/{token}', '\App\Http\Controllers\Auth\RegisterController@confirm');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Route::get('/dashboard/profil', [App\Http\Controllers\AdherentController::class, 'index'])->name('profil')->middleware(Authenticate ::class);
 
Route::get('/dashboard/profil/edit', [App\Http\Controllers\AdherentController::class, 'edit'])->name('edit')->middleware(Authenticate::class);

Route::PUT('/dashboard/profil/{Adherent}', [App\Http\Controllers\AdherentController::class, 'update'])->name('updateAdherent')->middleware(Authenticate::class);
 */

/* Route::name('dashboard.')->group(function () {
    Route::get('/profil', [App\Http\Controllers\AdherentController::class, 'index'])->name('profil')->middleware(Authenticate::class);
    Route::get('/profil/edit', [App\Http\Controllers\AdherentController::class, 'edit'])->name('edit')->middleware(Authenticate::class);
    Route::PUT('/profil/edit/{Adherent}', [App\Http\Controllers\AdherentController::class, 'update'])->name('updateAdherent')->middleware(Authenticate::class);;
}); */

Route::group([
    "prefix" => "dashboard",
    'as' => 'dashboard.'
], function () {
    Route::get('/profil', [App\Http\Controllers\AdherentController::class, 'index'])->name('profil')->middleware(Authenticate::class);
    Route::get('/profil/edit', [App\Http\Controllers\AdherentController::class, 'edit'])->name('profil.edit')->middleware(Authenticate::class);
    Route::get('/profil/beneficiaire', [App\Http\Controllers\AdherentController::class, 'viewBeneficiaires'])->name('profil.beneficiaire')->middleware(Authenticate::class);
    Route::PUT('/profil/edit/{id}', [App\Http\Controllers\AdherentController::class, 'update'])->name('profil.updateAdherent')->middleware(Authenticate::class);
    Route::get('/profil/Password', [App\Http\Controllers\AccountSetting::class, 'editPassword'])->name('profil.Password')->middleware(Authenticate::class);
    Route::PUT('/profil/changePassword', [App\Http\Controllers\AccountSetting::class, 'changePassword'])->name('profil.changePassword')->middleware(Authenticate::class);
});

// Route::get('/export', [App\Http\Controllers\EXportCarteController::class,'export'])->name('export');

// Route::get('/card', [App\Http\Controllers\Exportcard::class,'ViewCard'])->name('card');
// Route::POST('/savecard', [App\Http\Controllers\Exportcard::class,'saveCard'])->name('saveCard');
// Route::get('/Adherents', [App\Http\Controllers\TextSearchController::class, 'index'])->name('search');


// Pelerinage
Route::get('/pelerinage',  function () {
    return view('accueilPelerinage');
})->name('accueilPelerinage');
// Route::view('/adhesion/carte/liste-lots', 'liste-lots')->name('liste-lots');

Route::view('pelerinage/inscription', 'inscriptionPelerinage')->name('inscriptionPelerinage');

Route::post('/demande',  [App\Http\Controllers\inscriptionPelerinageController::class, 'demander'])->name('demandePelerinage');
//for displaying PDF
Route::get('/pdf', [PdfController::class, 'show'])->name('pdf.show');
