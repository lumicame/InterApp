<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

    public function index(Request $request)
    {
$request->user()->authorizeRoles(['student']);
    	$tipo="Estas Como Estudiante";
    	return view('student.index',compact('tipo'));
    }
}
