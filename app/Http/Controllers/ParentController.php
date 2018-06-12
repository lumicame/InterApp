<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    
    public function index(Request $request)
    {
		$request->user()->authorizeRoles(['parent']);
    	$tipo="Estas Como Padre";
    	return view('parent.index',compact('tipo'));
    }
}
