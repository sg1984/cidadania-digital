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
Route::resource('resources', ResourceController::class);
Route::get('/about', 'HomeController@about')->name('about');


Route::get('/search/tags/{tagId}', 'ResourceController@searchByTag')->name('searchByTag');
Route::get('/search/subject/{subjectId}', 'ResourceController@searchBySubject')->name('searchBySubject');
Route::get('/search/type/{typeId}', 'ResourceController@searchByFormat')->name('searchByFormat');
Route::get('/search/', 'ResourceController@showAll')->name('showAll');
Route::get('/search/user/{userId}', 'ResourceController@showByUser')->name('showByUser');

Route::group(['middleware' => ['auth', 'active_user']], function() {
    Route::get('/home', 'HomeController@home')->name('home');

    Route::get('users', 'Auth\RegisterController@showUsers')->name('showUsers');
    Route::get('users/{userId}', 'Auth\RegisterController@editUser')->name('editUser');
    Route::post('new-users', 'Auth\RegisterController@updateUser')->name('updateUser');
    Route::post('new-user', 'Auth\RegisterController@create')->name('create');
    Route::patch('users/{userId}/toggle-status', 'Auth\RegisterController@toggleStatus')->name('users.toggleStatus');

    Route::resource('tags', TagController::class);
    Route::patch('tags/{tagId}/toggle-status', 'TagController@toggleStatus')->name('tags.toggleStatus');

    Route::resource('subjects', SubjectController::class);
    Route::patch('subjects/{resourceId}/toggle-status', 'SubjectController@toggleStatus')->name('subjects.toggleStatus');

    Route::get('tickets/created', 'TicketController@myCreatedTickets')->name('tickets.myCreatedTickets');
    Route::get('tickets/received', 'TicketController@myReceivedTickets')->name('tickets.myReceivedTickets');
    Route::post('tickets/bug-report', 'TicketController@bugReport')->name('bugReport');
    Route::post('tickets/help-request', 'TicketController@helpRequest')->name('helpRequest');
    Route::post('tickets/resource-report', 'TicketController@resourceReport')->name('resourceReport');

    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/add-comment', 'TicketController@addComment')->name('tickets.addComment');
    Route::get('tickets/{ticket}/owner', 'TicketController@editOwner')->name('tickets.editOwner');
    Route::get('tickets/{ticket}/responsible', 'TicketController@editResponsible')->name('tickets.editResponsible');
});
