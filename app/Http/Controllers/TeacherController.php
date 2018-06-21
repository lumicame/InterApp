<?php

namespace App\Http\Controllers;

use App\School;
use App\Role;
use App\User;
use App\Classroom;
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
     public function ClassIndex(Request $request)
    {
        $request->user()->authorizeRoles(['teacher']);
        $shedules=$request->user()->shedules;
        return view('teacher.class.index', compact('shedules')); 
    }

    public function GroupIndex(Request $request)
    {
        $request->user()->authorizeRoles(['teacher']);
        $classrooms=$request->user()->group;
        return view('teacher.group.index', compact('classrooms')); 
    }

    public function GroupStudentIndex($id,Request $request)
    {
        $request->user()->authorizeRoles(['teacher']);
        $classroom=$request->user()->group->find($id);
       $students=$classroom->users;
       $students->class=$classroom->class." ".$classroom->classroom;
       return view('teacher.group.student.index', compact('students')); 
    }

     public function ClassStudentIndex($id,Request $request)
    {
        $request->user()->authorizeRoles(['teacher']);
        $shedules=$request->user()->shedules->find($id);
       $students=$shedules->classroom->users;
       $students->class=$shedules->classroom->class." ".$shedules->classroom->classroom." ".$shedules->subject->name;
       return view('teacher.class.student.index', compact('students')); 
    }
   
}
