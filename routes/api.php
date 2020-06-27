<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//routes for the authentication
Route::post('register' , 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');
Route::get('logout', 'API\AuthController@logout');


//routes for categories
Route::get('categories' , 'API\CategoryController@categories');
Route::post('category/create', 'API\CategoryController@create');
Route::post('category/update', 'API\CategoryController@update');
Route::post('category/delete' , 'API\CategoryController@destroy');



//routes for timetables
Route::get('/timetables' , 'API\TimeTableController@timetables')->middleware('jwtAuth');
Route::post('/timetable/create' , 'API\TimeTableController@create')->middleware('jwtAuth');
Route::post('/timetable/update', 'API\TimeTableController@update')->middleware('jwtAuth');
Route::post('/timetable/delete' , 'API\TimeTableController@destroy')->middleware('jwtAuth');

//ROUTES FOR JOURNAL
Route::post('journal/entry', 'API\JournalController@create')->middleware('jwtAuth');
Route::post('journal/delete', 'API\JournalController@delete')->middleware('jwtAuth');
Route::post('journal/update', 'API\JournalController@update')->middleware('jwtAuth');
Route::get('/journal', 'API\JournalController@journal')->middleware('jwtAuth');


//ROUTES FOR JOURNAL COMMENTS
Route::post('comment/entry', 'API\CommentsController@create')->middleware('jwtAuth');
Route::post('comment/delete', 'API\CommentsController@delete')->middleware('jwtAuth');
Route::post('comment/update', 'API\CommentsController@update')->middleware('jwtAuth');
Route::get('journal/comment', 'API\CommentsController@comment')->middleware('jwtAuth');



