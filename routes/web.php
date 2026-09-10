<?php
use Illuminate\Support\Facades\Route; use App\Http\Controllers\DashboardController; use App\Http\Controllers\Auth\LoginController; use App\Http\Controllers\Auth\GoogleController; use App\Http\Controllers\ServiceRequestController; use App\Http\Controllers\CompanyServiceController; use App\Http\Controllers\CompanyController; use App\Http\Controllers\ShipController; use App\Http\Controllers\UserController;
Route::get('/',fn()=>redirect()->route('dashboard'));

Route::get('/klaim', [\App\Http\Controllers\ClaimController::class, 'index'])->name('klaim.index');
Route::post('/klaim', [\App\Http\Controllers\ClaimController::class, 'submit'])->name('klaim.submit');

Route::middleware('guest')->group(function(){
    Route::get('/login',[LoginController::class,'show'])->name('login');
    Route::post('/login',[LoginController::class,'login'])->name('login.attempt');
    Route::view('/login-pemilik','auth.login_company')->name('login.company');
    Route::get('/auth/google',[GoogleController::class,'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback',[GoogleController::class,'callback'])->name('google.callback');
});

Route::get('/pelayanan/form/{token}', [App\Http\Controllers\ServiceRequestController::class, 'publicForm'])->name('public.form');
Route::post('/pelayanan/form/{token}', [App\Http\Controllers\ServiceRequestController::class, 'publicStore'])->name('public.form.store');

Route::middleware('auth')->group(function(){
    Route::get('/auth/google/callback/claim', [\App\Http\Controllers\ClaimController::class, 'processClaim'])->name('google.callback.claim');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/jadwal',[\App\Http\Controllers\JadwalController::class,'index'])->name('jadwal.index');
 Route::middleware('role:admin,petugas')->group(function(){Route::resource('/pelayanan',ServiceRequestController::class)->names('services')->only(['index','create','store','show']);Route::patch('/pelayanan/{service}/status',[ServiceRequestController::class,'updateStatus'])->name('services.status');Route::get('/companies',[CompanyController::class,'index'])->name('companies.index');Route::get('/companies/create',[CompanyController::class,'create'])->name('companies.create');Route::post('/companies',[CompanyController::class,'store'])->name('companies.store');Route::get('/companies/{company}/edit',[CompanyController::class,'edit'])->name('companies.edit');Route::put('/companies/{company}',[CompanyController::class,'update'])->name('companies.update');Route::delete('/companies/{company}',[CompanyController::class,'destroy'])->name('companies.destroy');Route::resource('/ships',ShipController::class)->only(['index','create','store','edit','update','destroy'])->names('ships');});
 Route::middleware('role:admin')->group(function(){Route::resource('/users',UserController::class)->only(['index','create','store','edit','update','destroy'])->names('users');});
 Route::middleware('role:company')->group(function(){
    Route::get('/company/pelayanan/{service}',[CompanyServiceController::class,'show'])->name('company.services.show');
    Route::post('/company/pelayanan/{service}',[CompanyServiceController::class,'respond'])->name('company.services.respond');
});
});
