<?php

namespace App\Http\Controllers;

use App\Role;
use App\School;
use App\User;
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
       public function index(Request $request)
    {
    	$request->user()->authorizeRoles(['coordinator']);
    	$tipo="Estas Como Coordinador";
    	return view('coordinator.index',compact('tipo'));
    }

    public function StudentIndex(Request $request)
    {
        $request->user()->authorizeRoles(['coordinator']);
        $school=School::find($request->user()->school->id);
        $classrooms=$school->classrooms()->orderBy('grade_id')->get();
        return view('coordinator.student.index', compact('classrooms')); 
    }
    public function TeacherIndex(Request $request)
    {
        $request->user()->authorizeRoles(['coordinator']);
        $roles=Role::where('name','teacher')->first();
        $teachers =User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();

        return view('coordinator.teacher.index', compact('teachers')); 
    }
     //pantalla para agregar, editar o eliminar una asignacion de materias
    public function AsingCourseIndex(Request $request)
    {
          $request->user()->authorizeRoles(['coordinator']);
        $school=School::find($request->user()->school->id);
        $classrooms=$school->classrooms;
        return view('coordinator.asingcourse.index', compact('classrooms')); 
    }
     //pantalla para agregar, editar o eliminar un salon de clases
    public function ClassRoomIndex(Request $request)
    {
        $request->user()->authorizeRoles(['coordinator']);
        $school=School::find($request->user()->school->id);
        $classroom=$school->classrooms;
        return view('coordinator.classroom.index', compact('classroom')); 
    }
}
