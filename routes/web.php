<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/companies', [App\Http\Controllers\CompaniesController::class, 'index'])->name('companies');
Route::any('/companies/add', [App\Http\Controllers\CompaniesController::class, 'add'])->name('company-add');
Route::any('/companies/edit/{id}', [App\Http\Controllers\CompaniesController::class, 'edit'])->name('company-edit');
Route::any('/companies/delete/{id}', [App\Http\Controllers\CompaniesController::class, 'delete'])->name('company-delete');

Route::any('/companies/notes/add', [App\Http\Controllers\CompanyNotesController::class, 'add'])->name('company-notes-add');
Route::any('/companies/notes/edit/{id}', [App\Http\Controllers\CompanyNotesController::class, 'edit'])->name('company-notes-edit');
Route::any('/companies/notes/delete/{id}', [App\Http\Controllers\CompanyNotesController::class, 'delete'])->name('company-notes-delete');

Route::any('/companies/links/add', [App\Http\Controllers\CompanyLinksController::class, 'add'])->name('company-links-add');
Route::any('/companies/links/edit/{id}', [App\Http\Controllers\CompanyLinksController::class, 'edit'])->name('company-links-edit');
Route::any('/companies/links/delete/{id}', [App\Http\Controllers\CompanyLinksController::class, 'delete'])->name('company-links-delete');

Route::get('/company/{id}', [App\Http\Controllers\CompaniesController::class, 'view'])->name('company-view');

Route::get('/invoices', [App\Http\Controllers\InvoicesController::class, 'index'])->name('invoices');
Route::any('/invoices/add', [App\Http\Controllers\InvoicesController::class, 'add'])->name('invoice-add');
Route::any('/invoices/edit/{id}', [App\Http\Controllers\InvoicesController::class, 'edit'])->name('invoice-edit');
Route::any('/invoices/delete/{id}', [App\Http\Controllers\InvoicesController::class, 'delete'])->name('invoice-delete');
Route::any('/invoices/print/{id}', [App\Http\Controllers\InvoicesController::class, 'print'])->name('invoice-print');
Route::get('/invoices/{id}', [App\Http\Controllers\InvoicesController::class, 'view'])->name('invoice-view');

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
Route::any('/users/add', [App\Http\Controllers\UsersController::class, 'add'])->name('users-add');
Route::any('/users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('users-edit');
Route::any('/users/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('users-delete');

Auth::routes();
Route::get('/register', function () {
    return redirect('/');
});
Route::get('/', function () {
    if(Auth::id()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});
