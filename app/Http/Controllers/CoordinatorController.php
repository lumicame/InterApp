<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
       public function index(Request $request)
    {
    	$request->user()->authorizeRoles(['coordinator']);
    	$tipo="Estas Como Coordinador";
    	return view('coordinator.index',compact('tipo'));
    }
}
