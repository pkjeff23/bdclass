<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/','frontcontroller@index');
Route::get('/Registro','frontcontroller@registro');
Route::post('/login','frontcontroller@login');
Route::get('/logout','frontcontroller@sesiones');

Route::get('/Grado','GradoController@index');
Route::post('/Grado','GradoController@create');
Route::any('/Grado/Editar/{id}','GradoController@update');
Route::delete('/Grado/Eliminar/{id}','GradoController@destroy');

Route::get('/Estudiante','EstudianteController@index');
Route::post('/Estudiante','EstudianteController@create');
Route::any('/Estudiante/Editar/{id}','EstudianteController@update');
Route::delete('/Estudiante/Eliminar/{id}','EstudianteController@destroy');

Route::get('/Profesor','ProfesorController@index');
Route::post('/Profesor','ProfesorController@create');
Route::any('/Profesor/Editar/{id}','ProfesorController@update');
Route::delete('/Profesor/Eliminar/{id}','ProfesorController@destroy');

Route::get('/Nota','MisAsignaturaController@index');

Route::get('/Cuenta','CuentaController@index');
Route::any('/Cuenta/Editar/{id}','CuentaController@update');
Route::get('/Lista','NotasController@index');
Route::get('/NuevaNota/{id}','NotasController@nueva');
Route::post('/GuardarNotas/{id}','NotasController@guardarNotas');


Route::get('/Asignatura','AsignaturaController@index');
Route::post('/Asignatura','AsignaturaController@create');
Route::any('/Asignatura/Editar/{id}','AsignaturaController@update');
Route::delete('/Asignatura/Eliminar/{id}','AsignaturaController@destroy');

Route::get('/Usuario','UsuarioController@index');
Route::post('/Usuario','UsuarioController@create');
Route::any('/Usuario/Editar/{id}','UsuarioController@update');
Route::delete('/Usuario/Eliminar/{id}','UsuarioController@destroy');

Route::get('/Curso','CursoController@index');
Route::post('/Curso','CursoController@create');
Route::any('/Curso/Editar/{id}','CursoController@update');
Route::delete('/Curso/Eliminar/{id}','CursoController@destroy');

Route::get('/Periodo','PeriodoController@index');
Route::post('/Periodo','PeriodoController@store');
Route::any('/Periodo/Editar/{id}','PeriodoController@update');
Route::delete('/Periodo/Eliminar/{id}','PeriodoController@destroy');

Route::get('/Rol','RolController@index');
Route::post('/Rol','RolController@create');
Route::any('/Rol/Editar/{id}','RolController@update');
Route::delete('/Rol/Eliminar/{id}','RolController@destroy');