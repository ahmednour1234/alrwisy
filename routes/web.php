<?php

use Illuminate\Support\Facades\Route;

Route::get('/',              fn () => view('auth.login'));
Route::get('/dashboard',     fn () => view('dashboard'))->name('dashboard');
Route::get('/employees',     fn () => view('employees.index'))->name('employees');
Route::get('/clients',       fn () => view('clients.index'))->name('clients');
Route::get('/cases',         fn () => view('cases.index'))->name('cases');
Route::get('/cases/{id}',    fn ($id) => view('cases.show', ['caseId' => $id]))->name('cases.show');
Route::get('/court-sessions',fn () => view('court-sessions.index'))->name('court-sessions');
Route::get('/tasks',         fn () => view('tasks.index'))->name('tasks');
Route::get('/enjaz',         fn () => view('enjaz.index'))->name('enjaz');
Route::get('/documents',     fn () => view('documents.index'))->name('documents');
Route::get('/reports',       fn () => view('reports.index'))->name('reports');
Route::get('/settings',      fn () => view('settings.index'))->name('settings');
