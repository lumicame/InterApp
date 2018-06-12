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


Route::get('/register/verify/{code}', 'AdminController@verify');
Auth::routes();

Route::middleware(['auth'])->group(function()
{
	//Rutas para las paginas de inicio de los diferentes usuarios
	Route::get('/', 'HomeController@index');
	Route::get('/admin', 'AdminController@index')->name('admin.home');	
	Route::get('/coordinator', 'CoordinatorController@index')->name('coordinator.home');
	Route::get('/teacher', 'TeacherController@index')->name('teacher.home');	
	Route::get('/parent', 'ParentController@index')->name('parent.home');
	Route::get('/student', 'StudentController@index')->name('student.home');

	/*Rutas para las paginas como administrador*/
		//Rutas para ver, agregar, editar y eliminar Coordinadores
		Route::get('/admin/coordinator', 'AdminController@CoordinatorIndex')->name('admin.coordinator.index');	
		Route::post('/admin/coordinator', 'AdminController@CoordinatorSave')->name('admin.coordinator.save');
		Route::post('/admin/coordinator', 'AdminController@CoordinatorUpdate')->name('admin.coordinator.update');
		Route::post('/admin/coordinator', 'AdminController@CoordinatorDelete')->name('admin.coordinator.delete');
		//Rutas para ver, agregar, editar y eliminar Docentes
		Route::get('/admin/teacher', 'AdminController@TeacherIndex')->name('admin.teacher.index');	
		Route::post('/admin/teacher', 'AdminController@TeacherSave')->name('admin.teacher.save');
		Route::post('/admin/teacher', 'AdminController@TeacherUpdate')->name('admin.teacher.update');
		Route::post('/admin/teacher', 'AdminController@TeacherDelete')->name('admin.teacher.delete');
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/admin/student', 'AdminController@StudentIndex')->name('admin.student.index');	
		Route::post('/admin/student', 'AdminController@StudentSave')->name('admin.student.save');
		Route::post('/admin/student', 'AdminController@StudentUpdate')->name('admin.student.update');
		Route::post('/admin/student', 'AdminController@StudentDelete')->name('admin.student.delete');

});


