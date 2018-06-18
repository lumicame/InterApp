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
        $roles=Role::where('name','student')->first();
        $classrooms=$school->classrooms;
        $students = User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();
        return view('coordinator.student.index', compact('classrooms')); 
    }
    public function TeacherIndex(Request $request)
    {
        $request->user()->authorizeRoles(['coordinator']);
        $roles=Role::where('name','teacher')->first();
        $teachers =User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();

        return view('coordinator.teacher.index', compact('teachers')); 
    }
}
