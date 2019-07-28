<?php

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
    return view('welcome');
});
Route::redirect('/home', '/');
Auth::routes();

Route::get('/home/{username}', 'UsersController@index')->name('user.show');


Route::get('/surveys/another', 'SurveysController@another');
Route::get('surveys/{survey}/start', 'SurveysController@start');
Route::get('surveys/{survey}/statistical', 'SurveysController@statistical');
Route::get('surveys/{survey}/detail', 'SurveysController@detail');
Route::resource('surveys', 'SurveysController');

Route::resource('questions', 'QuestionsController');

Route::resource('responses', 'ResponsesController');
