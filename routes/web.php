<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SoftwareProjectsController;
use App\Http\Controllers\ITProjectsController;
use App\Http\Controllers\WebProjectsController;

Route::get('/', [AppController::class, 'index']);
Route::get('/app', [AppController::class, 'index']);

// New page routes
Route::get('/home', [HomeController::class, 'index']);
Route::get('/projects', [ProjectsController::class, 'index']);
Route::get('/software-projects', [SoftwareProjectsController::class, 'index']);
Route::get('/it-projects', [ITProjectsController::class, 'index']);
Route::get('/web-projects', [WebProjectsController::class, 'index']);
Route::get('/reports', [ReportsController::class, 'index']);
Route::get('/events', [EventsController::class, 'index']);
Route::get('/deals', [DealsController::class, 'index']);
Route::get('/users', [UsersController::class, 'index']);
