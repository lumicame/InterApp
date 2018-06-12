<?php

namespace App\Http\Controllers;

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
}
