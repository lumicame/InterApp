<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

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
        $roles=Role::where('name','coordinator')->first()->users()->paginate(8);
        $coordinators=$roles;

        return view('admin.coordinator.index', compact('coordinators')); 
    }
    public function UserSave(Request $request)
    {
        $role_coordinator=Role::where('name','coordinator')->first();
        $count=User::all()->count();
        $user =new User();
        $user->name = $request->firstname." ".$request->secondname;
        $user->first_name=$request->firstname;
        $user->second_name=$request->secondname;
        $user->email =$request->email;
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('coordinador1234');
        $user->save();
            switch ($request->tipo) {
                case 'coordinator':
                   $user->roles()->attach($role_coordinator);
                    break;
                
                default:
                    # code...
                    break;
            }
        
        return response()->json($user);
    }
}
