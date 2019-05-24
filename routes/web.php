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
Route::post('/professores/cadastrar', 'ProfessorController@cadastrar')->name('professor.cadastrar');
Route::put('/professores/editar/{id}', 'ProfessorController@atualizar')->name('professor.editar');
Route::get('/professores/deletar/{id}', 'ProfessorController@deletar')->name('professor.deletar');


Route::get('/turmas/{id?}', 'TurmaController@index')->name('turmas');
Route::post('/turmas', 'TurmaController@cadastrar')->name('turma.cadastrar');
Route::put('/turmas/editar/{id}', 'TurmaController@atualizar')->name('turma.editar');
Route::get('/turmas/deletar/{id}', 'TurmaController@deletar')->name('turma.deletar');


Route::get('/alunos/{id?}', 'AlunoController@index')->name('alunos');
Route::post('/alunos', 'AlunoController@cadastrar')->name('aluno.cadastrar');
Route::put('/alunos/editar/{id}', 'AlunoController@atualizar')->name('aluno.editar');
Route::get('/alunos/deletar/{id}', 'AlunoController@deletar')->name('aluno.deletar');


Route::get('/horarios/{id?}', 'HorarioController@index')->name('horarios');
Route::post('/horarios', 'HorarioController@cadastrar')->name('horario.cadastrar');
Route::put('/horarios/editar/{id}', 'HorarioController@atualizar')->name('horario.editar');
Route::get('/horarios/deletar/{id}', 'HorarioController@deletar')->name('horario.deletar');