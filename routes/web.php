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

	Route::get('/superadmin','HomeController@super')->name('super.index');
	Route::post('/superadmin/school','HomeController@schoolSave')->name('super.save');
	Route::get('/superadmin/school/{id}','HomeController@schoolShow')->name('super.show');
	Route::post('/superadmin/school/{id}/edit','HomeController@schoolUpdate')->name('super.update');
	Route::post('/superadmin/school/{id}/delete','HomeController@schoolDelete')->name('super.delete');
	Route::get('/superadmin/dba','HomeController@DbaIndex')->name('super.dba.index');
	Route::get('/superadmin/dba/{id}','HomeController@DbaShow');
	Route::post('/superadmin/dba', 'HomeController@DbaSave')->name('super.dba.save');
	Route::post('/superadmin/dba/{id}/edit', 'HomeController@DbaUpdate');
	Route::post('/superadmin/dba/{id}/delete', 'HomeController@DbaDelete');
	Route::post('/superadmin/dba/question', 'HomeController@QuestionSave');
	Route::get('/superadmin/grade','HomeController@GradeIndex')->name('super.grade.index');
	Route::get('/superadmin/subject', 'HomeController@SubjectIndex')->name('super.subject.index');	
	Route::post('/superadmin/subject', 'HomeController@SubjectSave')->name('super.subject.save');
	Route::post('/superadmin/subject/{id}/edit', 'AdminController@SubjectUpdate');
	Route::post('/superadmin/subject/{id}/delete', 'AdminController@SubjectDelete');
	Route::get('/superadmin/question','HomeController@QuestionIndex')->name('super.question.index');
	Route::post('/superadmin/question/search','HomeController@QuestionSearch');
	Route::get('/superadmin/question/{id}','HomeController@QuestionShow');
	Route::post('/superadmin/question/{id}/edit', 'HomeController@QuestionUpdate');
	Route::post('/superadmin/question/{id}/delete', 'HomeController@QuestionDelete');


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
		Route::post('/admin/classroom/delete', 'AdminController@ClassroomDeleteDirector');

		//Rutas para ver, agregar, editar y eliminar los cursos de las clases
		Route::get('/admin/asingcourse', 'AdminController@AsingCourseIndex')->name('admin.asingcourse.index');	
		Route::post('/admin/asingcourse', 'AdminController@AsingCourseSave')->name('admin.asingcourse.save');
		Route::post('/admin/asingcourse/{id}/edit', 'AdminController@AsingCourseUpdate')->name('admin.asingcourse.update');
		Route::post('/admin/asingcourse/{id}/delete', 'AdminController@AsingCourseDelete')->name('admin.asingcourse.delete');

		//Rutas para la configuracion de la institucion
		Route::get('/admin/config', 'AdminController@ConfigIndex')->name('admin.config.index');	
		Route::post('/admin/config/school/{id}', 'AdminController@ConfigSchoolUpdate');

		


	/*Rutas como coordinador*/	
//Rutas para ver, agregar, editar y eliminar Coordinadores, profesores
		Route::get('/coordinator/user/{id}', 'AdminController@UserShow')->name('admin.user.show');
		Route::post('/coordinator/user', 'AdminController@UserSave')->name('admin.user.save');
		Route::post('/coordinator/user/{id}/edit', 'AdminController@UserUpdate')->name('admin.user.update');
		Route::post('/coordinator/user/{id}/delete', 'AdminController@UserDelete')->name('admin.user.delete');
		//Rutas para ver, agregar, editar y eliminar Docentes
		Route::get('/coordinator/teacher', 'CoordinatorController@TeacherIndex')->name('coordinator.teacher.index');			
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/coordinator/student', 'CoordinatorController@StudentIndex')->name('coordinator.student.index');
		//Rutas para ver, agregar, editar y eliminar Horarios
		Route::get('/coordinator/asingcourse', 'CoordinatorController@AsingCourseIndex')->name('coordinator.asingcourse.index');	
		Route::get('/coordinator/classroom', 'CoordinatorController@ClassRoomIndex')->name('coordinator.classroom.index');
		Route::get('/coordinator/classroom/{id}', 'AdminController@ClassroomShow');
		Route::post('/coordinator/classroom', 'AdminController@ClassroomSave');
		Route::post('/coordinator/classroom/{id}/edit', 'AdminController@ClassroomUpdate');
		Route::post('/coordinator/classroom/{id}/delete', 'AdminController@ClassroomDelete');
		Route::post('/coordinator/classroom/delete', 'AdminController@ClassroomDeleteDirector');

		//Rutas para la configuracion de su cuenta
		Route::get('/teacher/config', 'CoordinatorController@ConfigIndex')->name('coordinator.config.index');	
	/*Rutas como profesor*/
		//Rutas para ver, agregar, editar y eliminar Estudiantes
		Route::get('/teacher/clases', 'TeacherController@ClassIndex')->name('teacher.class.index');			
		Route::get('/teacher/clases/{id}', 'TeacherController@ClassStudentIndex')->name('teacher.class.student.index');	
		Route::post('/teacher/clases/evaluation', 'TeacherController@EvaluationSave');
		Route::get('/teacher/clases/evaluation/{id}', 'TeacherController@EvaluationShow');	
		Route::post('/teacher/clases/evaluation/{id}/activar', 'TeacherController@EvaluationActivar');
		Route::post('/teacher/clases/evaluation/{id}/edit', 'TeacherController@EvaluationUpdate');
		Route::post('/teacher/clases/evaluation/{id}/delete', 'TeacherController@EvaluationDelete');
		Route::post('/teacher/clases/evaluation/question', 'TeacherController@EvaluationQuestionSave');
		//Rutas para la configuracion de su cuenta
		Route::get('/teacher/config', 'TeacherController@ConfigIndex')->name('teacher.config.index');	
		Route::post('/teacher/config/profile', 'HomeController@ProfileUpdate');
		
		

		Route::get('/teacher/grupos', 'TeacherController@GroupIndex')->name('teacher.group.index');
		Route::get('/teacher/grupos/{id}/estudiantes', 'TeacherController@GroupStudentIndex')->name('teacher.group.student.index');

Route::get('/user/profile', 'HomeController@ProfileIndex')->name('user.profile.index');
Route::post('/user/config/profile', 'HomeController@ProfileUpdate');

});


