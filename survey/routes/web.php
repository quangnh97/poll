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
Auth::routes();

Route::get('/home', 'UsersController@index')->name('home');


Route::get('/surveys/another', 'SurveysController@another');
Route::get('surveys/{survey}/start', 'SurveysController@start');
Route::get('surveys/{survey}/statistical', 'SurveysController@statistical');
Route::get('surveys/{survey}/detail', 'SurveysController@detail');
Route::resource('surveys', 'SurveysController');

Route::resource('questions', 'QuestionsController');
Route::group(['prefix' => 'option'] , function() {
    Route::post('', 'OptionController@store')->name('store-options');
});
Route::post('questions/{question}/options', 'QuestionsController@options');
Route::resource('responses', 'ResponsesController');

Route::get('system-review', 'ReviewController@store');
