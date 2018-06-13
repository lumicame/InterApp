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

	Route::get('/superadmin','HomeController@super');
	Route::post('/superadmin/school','HomeController@schoolSave');
	Route::post('/superadmin/school/{id}/delete','HomeController@schoolDelete');
	//Rutas para las paginas de inicio de los diferentes usuarios
	Route::get('/', 'HomeController@index');
	Route::get('/admin', 'AdminController@index')->name('admin.home');	
	Route::get('/coordinator', 'CoordinatorController@index')->name('coordinator.home');
	Route::get('/teacher', 'TeacherController@index')->name('teacher.home');	
	Route::get('/parent', 'ParentController@index')->name('parent.home');
	Route::get('/student', 'StudentController@index')->name('student.home');

	/*Rutas para las paginas como administrador*/
	
		//Rutas para ver, agregar, editar y eliminar Coordinadores
		Route::get('/admin/user/{id}', 'AdminController@UserShow')->name('admin.user.show');
		Route::post('/admin/user', 'AdminController@UserSave')->name('admin.user.save');
		Route::post('/admin/user/{id}/edit', 'AdminController@UserUpdate')->name('admin.user.update');
		Route::post('/admin/user/{id}/delete', 'AdminController@UserDelete')->name('admin.user.delete');

		//Rutas para ver, agregar, editar y eliminar Coordinadores
		Route::get('/admin/coordinator', 'AdminController@CoordinatorIndex')->name('admin.coordinator.index');	
		//Rutas para ver, agregar, editar y eliminar Docentes
		Route::get('/admin/teacher', 'AdminController@TeacherIndex')->name('admin.teacher.index');	
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/admin/student', 'AdminController@StudentIndex')->name('admin.student.index');	

});


