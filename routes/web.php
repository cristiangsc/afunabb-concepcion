<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'render'])->name('welcome');
Route::get('nosotros', [\App\Http\Controllers\WelcomeController::class, 'about'])->name('about');
Route::post('contact', [\App\Http\Controllers\WelcomeController::class, 'send'])->name('contact');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'render'])->name('dashboard');
    Route::get('bancos', App\Livewire\Mantenedores\Banco\Index::class)->middleware('can_view:bancos')->name('bancos');
    Route::get('cargos', App\Livewire\Mantenedores\Cargo\Index::class)->middleware('can_view:cargos')->name('cargos');
    Route::get('comunas', App\Livewire\Mantenedores\Comuna\Index::class)->middleware('can_view:comunas')->name('comunas');
    Route::get('cuentas', App\Livewire\Mantenedores\Cuenta\Index::class)->middleware('can_view:cuentas')->name('cuentas');
    Route::get('reparticiones', App\Livewire\Mantenedores\Reparticion\Index::class)->middleware('can_view:reparticion')->name('reparticiones');
    Route::get('sedes', App\Livewire\Mantenedores\Sede\Index::class)->middleware('can_view:sedes')->name('sedes');
    Route::get('galeria', App\Livewire\Galeria\Index::class)->middleware('can_view:galeria')->name('galeria');
    Route::get('noticias', App\Livewire\Noticias\Index::class)->middleware('can_view:noticias')->name('noticias');
    Route::get('actas', App\Livewire\Actas\Index::class)->middleware('can_view:actas')->name('actas');
    Route::get('documentos', App\Livewire\Documentos\Index::class)->middleware('can_view:documentos')->name('documentos');
    Route::get('beneficios', App\Livewire\Beneficios\Index::class)->middleware('can_view:beneficios')->name('beneficios');
    Route::get('noticias/{id}',App\Livewire\Noticias\Show::class)->middleware('can_view:noticias')->name('noticias.ver');
    Route::get('aportes', App\Livewire\Contabilidad\SociosCuota\Index::class)->middleware('can_view:aportes')->name('aportes');
    Route::get('users/constancias', App\Livewire\Constancias\Index::class)->middleware('can_view:constancias')->name('constancias');
    Route::get('users/beneficios', App\Livewire\BeneficiosOtorgados\Index::class)->middleware('can_view:beneficiosOtorgados')->name('beneficios.otorgados');
    Route::get('directorio', App\Livewire\Directorios\Index::class)->middleware('can_view:directiva')->name('directorios');
    Route::get('user/constancias', App\Livewire\Users\Constancias\Index::class)->middleware('can_view:misConstancias')->name('user.constancias');
    Route::get('user/beneficios', App\Livewire\Users\Beneficios\Index::class)->middleware('can_view:misBeneficios')->name('user.beneficios');
    Route::get('slides', App\Livewire\Slides\Index::class)->middleware('can_view:slides')->name('slides');
    Route::get('fotografia', App\Livewire\Directorios\Photo\Index::class)->middleware('can_view:galeria')->name('photos');
    Route::get('saludos', App\Livewire\Birthdays\Index::class)->middleware('can_view:saludos')->name('saludos');
    Route::get('galeria/upload/{id}', App\Livewire\Galeria\Upload::class)->middleware('can_view:galeria')->name('upload');
    Route::get('galeria/{id}', App\Livewire\Galeria\Show::class)->middleware('can_view:galeria')->name('show');
    Route::get('testimonios', App\Livewire\Testimonials\Index::class)->middleware('can_view:testimonios')->name('testimony');
    Route::get('aboutme', App\Livewire\AboutMe\Index::class)->middleware('can_view:acerca')->name('aboutme');
});

Route::get('users', App\Livewire\Users\Index::class)->middleware('can_view:usuarios')->name('users');
Route::get('roles', App\Livewire\Roles\RolePermissionTable::class)->middleware('can_view:role')->name('roles');

Route::get('/constancia-pdf/{constancia}', [App\Livewire\Constancias\Index::class, 'imprimirPdfConstancia'])->name('pdfconstancia');
Route::get('/pdf-constancia/{constancia}', [App\Livewire\Users\Constancias\Index::class, 'constanciaPdf'])->name('constanciapdf');

