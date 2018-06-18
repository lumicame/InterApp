<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\School;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
    	$request->user()->authorizeRoles(['admin']);
    	$tipo="estas Como Administrador";
    	return view('admin.index',compact('tipo'));
    }
    public function verify($code)
    {
            $user = User::where('confirmation_code', $code)->first();

            if (! $user)
                return redirect('/');

            $user->confirmed = true;
            $user->confirmation_code = null;
            $user->save();

            return redirect('/')->with('notification', 'Has confirmado correctamente tu correo!');
    }


    public function CoordinatorIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $roles=Role::where('name','coordinator')->first();
        $coordinators = User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();
        return view('admin.coordinator.index', compact('coordinators')); 
    }
    public function StudentIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $roles=Role::where('name','student')->first();
        $classrooms=$school->classrooms;
        $students = User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();
        return view('admin.student.index', compact('classrooms')); 
    }
    public function TeacherIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $roles=Role::where('name','teacher')->first();
        $teachers =User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();

        return view('admin.teacher.index', compact('teachers')); 
    }
    public function UserShow($id)
    {
        $user= User::find($id);
        return response()->json($user);
    }
    public function UserSave(Request $data)
    {
        $school=School::find($data->user()->school->id);
        $array=$data->all();
        $role_coordinator=Role::where('name','coordinator')->first();
        $role_teacher=Role::where('name','teacher')->first();
        $role_student=Role::where('name','student')->first();
        $array['pass']=str_random(8);
        $count=User::all()->count();
        $user =new User();
        $user->name = $data->firstname." ".$data->secondname;
        $user->first_name=$data->firstname;
        $user->second_name=$data->secondname;
        $user->email =$data->email;
        $user->password = bcrypt($array['pass']);
        $user->save();
        $user->username="T".str_pad($user->id, 8, "0",STR_PAD_LEFT);
            switch ($data->tipo) {
                case 'coordinator':
                   $user->roles()->attach($role_coordinator);
                    $user->role_id=$role_coordinator->id;
                    break;
                case 'student':
                   $user->roles()->attach($role_student);
                   $user->role_id=$role_student->id;
                   $classroom=Classroom::find($data->classroom_id);
                   $classroom->users()->save($user);
                    break;
                case 'teacher':
                   $user->roles()->attach($role_teacher);
                   $user->role_id=$role_teacher->id;
                    break;
                default:
                    # code...
                    break;
            }
            $user->save();
            $school->users()->save($user);
            $array['name']=$data->firstname." ".$data->secondname;
            $array['codigo']=$user->username;
            $array['name_u']=$school->name;
            Mail::send('emails.confirmation_code', $array, function($message) use ($data) {
            $message->to($data->email, $data->name)->subject('Datos para iniciar en la plataforma virtual InterApp');});
            $view = view('admin.recursos.user')->with('user',$user)->render();
            return response()->json(['data'=>$view,'id'=>"".$user->id]);
    }
    public function UserUpdate(Request $request, $id)
    {
        $user=User::find($id);
        $user->name = $request->firstname." ".$request->secondname;
        $user->first_name=$request->firstname;
        $user->second_name=$request->secondname;
        $user->email =$request->email;
        $user->save();
        return response()->json($user);     
    }
    public function UserDelete($id)
    {
        $user=User::find($id);
        $user->delete();
        return response()->json($user);
          
    }
    public function ClassroomIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $classroom=$school->classrooms;
        return view('admin.classroom.index', compact('classroom')); 
    }
    public function ClassroomShow($id)
    {
        $class= Classroom::find($id);
        return response()->json($class);
    }
    public function ClassroomSave(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $classroom =new Classroom();
        $classroom->class = $request->class;
        $classroom->classroom="Aula ".$request->classroom;
        $classroom->jornada=$request->jornada;
        $classroom->save();
        $school->classrooms()->save($classroom);
        $view = view('admin.classroom.classroom')->with('class',$classroom)->render();
        return response()->json(['data'=>$view,'id'=>"".$classroom->id]);
    }
    public function ClassroomUpdate(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin']);
        $classroom= Classroom::find($id); 
        $classroom->class = $request->class_edit;
        $classroom->classroom=$request->classroom_edit;
        $classroom->jornada=$request->jornada_edit;
        $classroom->save();
        return response()->json($classroom);
    }
    public function ClassroomDelete($id)
    {
        $request->user()->authorizeRoles(['admin']);
         $class= Classroom::find($id);
         $class->delete();
        return response()->json($class);
    }
}
