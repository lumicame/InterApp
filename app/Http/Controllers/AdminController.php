<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\School;
use App\Classroom;
use App\Subject;
use App\Date;
use App\Shedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //Pantalla principal para el administrador
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

    //pantalla para agregar, editar y eliminar a los coordinadores
    public function CoordinatorIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $roles=Role::where('name','coordinator')->first();
        $coordinators = User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();
        return view('admin.coordinator.index', compact('coordinators')); 
    }
    //pantalla para agregar, editar y eliminar a los estudiantes
    public function StudentIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $classrooms=$school->classrooms()->orderBy('grade_id')->get();
        return view('admin.student.index', compact('classrooms')); 
    }
    //pantalla para agregar, editar y eliminar a los docentes
    public function TeacherIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $roles=Role::where('name','teacher')->first();
        $teachers =User::where([['role_id', '=', $roles->id],['school_id', '=', $request->user()->school->id]])->get();

        return view('admin.teacher.index', compact('teachers')); 
    }
    //pantalla para buscar a un usuario
    public function UserShow($id)
    {
        $user= User::find($id);
        return response()->json($user);
    }
    //pantalla para agregar un nuevo usuario
    public function UserSave(Request $data)
    {
        $school=School::find($data->user()->school->id);
        $array=$data->all();
        $array['pass']=str_random(8);
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
                    $role_coordinator=Role::where('name','coordinator')->first();
                   $user->roles()->attach($role_coordinator);
                    $user->role_id=$role_coordinator->id;
                    break;
                case 'student':
                    $role_student=Role::where('name','student')->first();
                   $user->roles()->attach($role_student);
                   $user->role_id=$role_student->id;
                   $classroom=Classroom::find($data->classroom_id);
                   $classroom->users()->save($user);
                    break;
                case 'teacher':
                    $role_teacher=Role::where('name','teacher')->first();
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
            $message->to($data->email, $data->name)->subject('Datos para iniciar sesión en la plataforma virtual InterApp');});
            $view = view('admin.recursos.user')->with('user',$user)->render();
            return response()->json(['data'=>$view,'id'=>"".$user->id]);
    }
    //pantalla para editar a un usuario
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
    //pantalla para eliminar a un usuario
    public function UserDelete($id)
    {
        $user=User::find($id);
        $user->delete();
        return response()->json($user);
          
    }
    //pantalla para agregar, editar o eliminar un salon de clases
    public function ClassroomIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $classroom=$school->classrooms()->orderBy('grade_id')->get();
        return view('admin.classroom.index', compact('classroom')); 
    }
    //pantalla para buscar a un salon de clases
    public function ClassroomShow($id)
    {
        $class= Classroom::find($id);
        return response()->json($class);
    }    
    //pantalla para guardar un salon de clases
    public function ClassroomSave(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $user =User::find($request->user);
        $school=School::find($request->user()->school->id);
        $classroom =new Classroom();
        $classroom->class = $request->class;
        $classroom->classroom="Aula ".$request->classroom;
        $classroom->jornada=$request->jornada;
        $classroom->grade_id=$request->grade;
        $classroom->quota=$request->quota;
        $classroom->save();
        $classroom->director()->attach($user);
        $school->classrooms()->save($classroom);
        $view = view('admin.classroom.classroom')->with('class',$classroom)->render();
        return response()->json(['data'=>$view,'id'=>"".$classroom->id]);
    }
    //pantalla para editar un salon de clases
    public function ClassroomUpdate(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin']);
        $classroom= Classroom::find($id); 
        $classroom->class = $request->class_edit;
        $classroom->classroom=$request->classroom_edit;
        $classroom->jornada=$request->jornada_edit;
        $classroom->grade_id=$request->grade;
        $classroom->quota=$request->quota;
        $classroom->save();
        $classroom->grade_edit=$classroom->grade->name;
        return response()->json($classroom);
    }    
    //pantalla para eliminar un salon de clases
    public function ClassroomDelete($id,Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
         $class= Classroom::find($id);
         $class->delete();
        return response()->json($class);
    }
    //pantalla para agregar, editar o eliminar una asignacion de materias
    public function AsingCourseIndex(Request $request)
    {
          $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $classrooms=$school->classrooms()->orderBy('grade_id')->get();
        return view('admin.asingcourse.index', compact('classrooms')); 
    }
    //pantalla para agregar una asignacion de materias
    public function AsingCourseSave(Request $request)
    {
         $classroom=Classroom::find($request->classroom_id);
        $subject=Subject::find($request->subject_id);
        $user=User::find($request->user_id);
        $date1=new Date();
        $date1->star =$request->inicio.' '.$request->inicio_time;
        $date1->end=$request->fin.' '.$request->fin_time;
        $date1->day=$request->day;
        $date1->save();
        $shedule = new Shedule();
        $shedule->subject_id=$subject->id;
        $shedule->classroom_id=$classroom->id;
        $shedule->user_id=$user->id;
        $shedule->save();
        $shedule->dates()->save($date1);
         $view = view('admin.asingcourse.course')->with('shedule',$shedule)->render();
        return response()->json(['data'=>$view,'id'=>"".$shedule->id]);
    }
    //pantalla para editar una asignacion de materias
    public function AsingCourseUpdate(Request $request,$id)
    {
        $shedule = Shedule::FindOrFail($id);
        $date1=new Date();
        $date1->star =$request->inicio.' '.$request->inicio_time;
        $date1->end=$request->fin.' '.$request->fin_time;
        $date1->day=$request->day;
        $date1->save();
        $shedule->dates()->save($date1);
        $shedule->fecha=$date1->day." ".$date1->star." - ".$date1->end;
        return response()->json($shedule); 
    }
    //pantalla para eliminar una asignacion de materias
    public function AsingCourseDelete($id)
    {
        $shedule = Shedule::FindOrFail($id);
        $shedule->delete();
        return response()->json($shedule);
    }

     public function SubjectIndex(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $subjects =Subject::where([['school_id', '=', null]])->get();
        return view('admin.subject.index', compact('subjects')); 
    }
    public function SubjectShow($id)
    {
        $subject= Subject::find($id);
        return response()->json($subject);
    }
    public function SubjectSave(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $school=School::find($request->user()->school->id);
        $subject =new Subject();
        $subject->name = $request->materia;
        $subject->save();
        $school->subjects()->save($subject);
        $view = view('admin.subject.subject')->with('subject',$subject)->render();
        return response()->json(['data'=>$view,'id'=>"".$subject->id]);
    }
    public function SubjectUpdate(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin','super']);
        $subject= Subject::find($id); 
        $subject->name = $request->materia_edit;
        $subject->save();
        return response()->json($subject);
    }
    public function SubjectDelete($id,Request $request)
    {
        $request->user()->authorizeRoles(['admin','super']);
         $subject= Subject::find($id);
         $subject->delete();
        return response()->json($subject);
    }

}
