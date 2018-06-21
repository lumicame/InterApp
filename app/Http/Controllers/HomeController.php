<?php

namespace App\Http\Controllers;

use App\School;
use App\Role;
use App\User;
use App\Subject;
use App\Dba;
use Illuminate\Support\Facades\Mail;
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
        $request->user()->authorizeRoles(['teacher', 'admin','parent','student','coordinator','super']);

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
    public function super(Request $request)
    {
        $request->user()->authorizeRoles(['super']);

        if ($request->user()->hasRole('super'))
        {
        $schools=School::all();
        return view('super.index',compact('schools')); 
        }
    }

    public function schoolSave(Request $data)
    {
        $request->user()->authorizeRoles(['super']);
        $array=$data->all();
        $role=Role::where('name','admin')->first();
        $array['pass']=str_random(8);
        $school=new School();
        $school->name=$data->name_add;
        $school->nit=str_random(8);
        $school->email=$data->email_add;
        $school->phone=$data->number_add;
        $school->save();
        $user =new User();
        $user->name = $data->first_name_admin_add." ".$data->second_name_admin_add;
        $user->first_name=$data->first_name_admin_add;
        $user->second_name=$data->second_name_admin_add;
        $user->email =$data->email_add;
        $user->password = bcrypt($array['pass']);
        $user->role_id=$role->id;
        $user->save();
        $user->username="T".str_pad($user->id, 8, "0",STR_PAD_LEFT);
        $user->save();
        $user->roles()->attach($role);
        $school->users()->save($user);
            $array['name']=$data->firstname." ".$data->secondname;
            $array['codigo']=$user->username;
         Mail::send('emails.school', $array, function($message) use ($data) {
        $message->to($data->email_add, $data->name_add)->subject('Te Damos La Bienvenida A InterApp!');});
        return response()->json($school);
    }
    public function schoolShow($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $school=School::find($id);
        return response()->json($school);
    }
    public function schoolUpdate(Request $data,$id)
    {
        $data->user()->authorizeRoles(['super']);
        $array=$data->all();
        $school=School::find($id);
        $school->name=$data->name_edit;
        $school->phone=$data->number_edit;
        $school->email=$data->email_edit;
        $school->save();
        return response()->json($school);
    }
    public function schoolDelete($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $school=School::find($id);
        $school->delete();
     return response()->json($school);
    }
    public function DbaIndex(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
         $dbas=Dba::all();   
         return view('super.dba.index', compact('dbas')); 
    }
      public function DbaSave(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
         $dba=new Dba();   
        $view = view('super.dba.dba')->with('dba',$dba)->render();
        return response()->json(['data'=>$view,'id'=>"".$dba->id]);
    }
      public function DbaDelete($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
         $dba=Dba::find($id);   
    
        return response()->json($dba); 
    }
    public function GradeIndex(Request $request)
    {
        $request->user()->authorizeRoles(['super']);

    }

    public function SubjectIndex(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $subjects =Subject::where([['school_id', '=', null]])->get();
        return view('super.subject.index', compact('subjects')); 
    }
    public function SubjectSave(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $subject =new Subject();
        $subject->name = $request->materia;
        $subject->save();
        $view = view('admin.subject.subject')->with('subject',$subject)->render();
        return response()->json(['data'=>$view,'id'=>"".$subject->id]);
    }

  
}

