<?php

use App\Resource;
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

Auth::routes();
Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@home')->name('home');
Route::get('/search/tags/{tagId}', 'ResourceController@searchByTag')->name('searchByTag');
Route::get('/search/subject/{subjectId}', 'ResourceController@searchBySubject')->name('searchBySubject');
Route::get('/search/type/{typeId}', 'ResourceController@searchByFormat')->name('searchByFormat');
Route::get('/search/', 'ResourceController@showAll')->name('showAll');
Route::resource('resources', ResourceController::class);
