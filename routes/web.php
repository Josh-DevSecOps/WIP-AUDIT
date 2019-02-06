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

//Route Protocoles
Route::resource('Protocoles', 'ProtocolesController');
Route::post('/deleteProtocoles', 'ProtocolesController@destroy');
Route::put('/Protocoles', 'ProtocolesController@UpdateProtocoles');
Route::get('/listProtocoles', 'ProtocolesController@show');
/*Route::get('/protocole', 'ProtocolesController@index');
Route::post('/protocoleadd', 'ProtocolesController@store');*/



// Route StatusRisks
Route::resource('StatusRisks', 'StatusRisksController');
Route::post('/NewStatusRisks','StatusRisksController@store');
Route::post('/deleteStatusRisks', 'StatusRisksController@destroy');

Route::get('/listStatusRisks', 'StatusRisksController@show');
Route::put('/NewStatusRisks', 'StatusRisksController@UpdateStatusRisks');


// Route Menaces
Route::resource('Menaces', 'MenacesController');
Route::post('/NewMenaces','MenacesController@store');
Route::post('/deleteMenaces', 'MenacesController@destroy');
Route::get('/listMenaces', 'MenacesController@show');
Route::put('/NewMenaces', 'MenacesController@UpdateMenaces');



// Route Vulnerabilites
Route::resource('Vulnerabilites', 'VulnerabilitesController');
Route::post('/NewVulnerabilites','VulnerabilitesController@store');

//Route expereinces

Route::resource('experience','ExperiencesController');
Route::post('/NewExperiences','ExperiencesController@store');
Route::post('/deleteExperiences', 'ExperiencesController@destroy');


