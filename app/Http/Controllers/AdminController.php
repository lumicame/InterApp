<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
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
        $roles=Role::where('name','coordinator')->first()->users;

        $coordinators=$roles;

        return view('admin.coordinator.index', compact('coordinators')); 
    }
    public function StudentIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $roles=Role::where('name','student')->first()->users;

        $students=$roles;

        return view('admin.student.index', compact('students')); 
    }
    public function TeacherIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $roles=Role::where('name','teacher')->first()->users;

        $teachers=$roles;

        return view('admin.teacher.index', compact('teachers')); 
    }
    public function UserShow($id)
    {
        $user= User::find($id);
        return response()->json($user);
    }
    public function UserSave(Request $data)
    {
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
        $user->save();
            switch ($data->tipo) {
                case 'coordinator':
                   $user->roles()->attach($role_coordinator);
                    break;
                case 'student':
                   $user->roles()->attach($role_student);
                    break;
                case 'teacher':
                   $user->roles()->attach($role_teacher);
                    break;
                default:
                    # code...
                    break;
            }
            $array['name']=$data->firstname." ".$data->secondname;
            $array['codigo']=$user->username;
         Mail::send('emails.confirmation_code', $array, function($message) use ($data) {
        $message->to($data->email, $data->name)->subject('Datos para iniciar en la plataforma virtual InterApp');});
        return response()->json($user);
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
}
