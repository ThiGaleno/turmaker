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
    return view('index');
});



Route::get('/professores/{id?}', 'ProfessorController@index')->name('professores');
Route::post('/professores', 'ProfessorController@cadastrar')->name('professor.cadastrar');
Route::put('/professores/{id}', 'ProfessorController@atualizar')->name('professor.editar');



