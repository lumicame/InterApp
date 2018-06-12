<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        $request->user()->authorizeRoles(['teacher', 'admin','parent','student','coordinator']);

        if ($request->user()->hasRole('admin'))
        {
            return redirect()->route('admin.home');
        }

        else if($request->user()->hasRole('teacher'))
        {          
            return redirect()->route('teacher.home');
        }

        elseif ($request->user()->hasRole('parent'))
        {
            return redirect()->route('parent.home');
        } 

        elseif ($request->user()->hasRole('student')) 
        {
            return redirect()->route('student.home');
        }

        elseif ($request->user()->hasRole('coordinator')) 
        {
            return redirect()->route('coordinator.home');
        }

    }
}
