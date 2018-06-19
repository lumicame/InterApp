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
	Route::get('/superadmin/school/{id}','HomeController@schoolShow');
	Route::post('/superadmin/school/{id}/edit','HomeController@schoolUpdate');
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
		Route::get('/admin/coordinator', 'AdminController@CoordinatorIndex')->name('admin.coordinator.index');	
		//Rutas para ver, agregar, editar y eliminar Docentes
		Route::get('/admin/teacher', 'AdminController@TeacherIndex')->name('admin.teacher.index');	
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/admin/student', 'AdminController@StudentIndex')->name('admin.student.index');	
		
		//Rutas para ver, agregar, editar y eliminar Coordinadores, profesores
		Route::get('/admin/user/{id}', 'AdminController@UserShow')->name('admin.user.show');
		Route::post('/admin/user', 'AdminController@UserSave')->name('admin.user.save');
		Route::post('/admin/user/{id}/edit', 'AdminController@UserUpdate')->name('admin.user.update');
		Route::post('/admin/user/{id}/delete', 'AdminController@UserDelete')->name('admin.user.delete');

		//Rutas para ver, agregar, editar y eliminar los salones de clases
		Route::get('/admin/classroom', 'AdminController@ClassroomIndex')->name('admin.classroom.index');	
		Route::get('/admin/classroom/{id}', 'AdminController@ClassroomShow')->name('admin.classroom.show');
		Route::post('/admin/classroom', 'AdminController@ClassroomSave')->name('admin.classroom.save');
		Route::post('/admin/classroom/{id}/edit', 'AdminController@ClassroomUpdate')->name('admin.classroom.update');
		Route::post('/admin/classroom/{id}/delete', 'AdminController@ClassroomDelete')->name('admin.classroom.delete');

		//Rutas para ver, agregar, editar y eliminar los cursos de las clases
		Route::get('/admin/asingcourse', 'AdminController@AsingCourseIndex')->name('admin.asingcourse.index');	
		Route::get('/admin/asingcourse/{id}', 'AdminController@AsingCourseShow')->name('admin.asingcourse.show');
		Route::post('/admin/asingcourse', 'AdminController@AsingCourseSave')->name('admin.asingcourse.save');
		Route::post('/admin/asingcourse/{id}/edit', 'AdminController@AsingCourseUpdate')->name('admin.asingcourse.update');
		Route::post('/admin/asingcourse/{id}/delete', 'AdminController@AsingCourseDelete')->name('admin.asingcourse.delete');

		//Rutas como coordinador		
		//Rutas para ver, agregar, editar y eliminar Docentes
		Route::get('/coordinator/teacher', 'CoordinatorController@TeacherIndex')->name('coordinator.teacher.index');			
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/coordinator/student', 'CoordinatorController@StudentIndex')->name('coordinator.student.index');	


		//Rutas como profesor
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/teacher/student', 'TeacherController@StudentIndex')->name('teacher.student.index');	

});


