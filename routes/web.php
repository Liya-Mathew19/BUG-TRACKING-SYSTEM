<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::match(['get', 'post'],'/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-project', [App\Http\Controllers\ProjectsController::class, 'add_project'])->name('add-project');
Route::post('/addProject', [App\Http\Controllers\ProjectsController::class, 'store'])->name('addProject');
Route::get('/add-issue/{id}', [App\Http\Controllers\IssuesController::class, 'add_issue'])->name('add-issue');
Route::match(['get', 'post'],'/issues/{id}', [App\Http\Controllers\IssuesController::class, 'issueView'])->name('issues');
Route::post('/addIssues/{id}', [App\Http\Controllers\IssuesController::class, 'store'])->name('addIssues');
Route::match(['get', 'post'], '/changeStatus/{id}',[App\Http\Controllers\IssuesController::class, 'changeStatus'])->name('changeStatus');
Route::match(['get', 'post'], '/changeProjectStatus/{id}',[App\Http\Controllers\ProjectsController::class, 'changeProjectStatus'])->name('changeProjectStatus');
Route::match(['get', 'post'], '/filterTracker/{id}/{tracker}',[App\Http\Controllers\IssuesController::class, 'filterTracker'])->name('filterTracker');
Route::get('/editIssue/{id}', [App\Http\Controllers\IssuesController::class, 'editIssue'])->name('editIssue');
Route::post('/updateIssue/{id}', [App\Http\Controllers\IssuesController::class, 'updateIssue'])->name('updateIssue');
Route::post('/searchIssues/{id}', [App\Http\Controllers\IssuesController::class, 'searchIssues'])->name('searchIssues');