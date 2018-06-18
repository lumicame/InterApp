<?php

namespace App\Http\Controllers;

use App\School;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //

    public function index(Request $request)
    {
		$request->user()->authorizeRoles(['teacher']);
    	$tipo="Estas Como Docente";
    	return view('teacher.index',compact('tipo'));
    }
     public function StudentIndex(Request $request)
    {
        $request->user()->authorizeRoles(['teacher']);
        $school=School::find($request->user()->school->id);
        $roles=Role::where('name','student')->first();
        $classrooms=$school->classrooms;
        $students = User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();
        return view('teacher.student.index', compact('classrooms')); 
    }
}
