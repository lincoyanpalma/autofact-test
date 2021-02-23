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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/survey', 'HomeController@survey')->name('home');
Route::post('/survey', 'HomeController@sendSurvey')->name('send_survey');
Route::get('/stats', 'HomeController@stats')->name('stats');
