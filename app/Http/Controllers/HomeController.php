<?php

namespace App\Http\Controllers;

use App\School;
use App\Role;
use App\User;
use App\Subject;
use App\Dba;
use App\Question;
use App\Profile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


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

        if ($request->user()->hasRole('super'))
        {
            return redirect()->route('super.index');
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
        $data->user()->authorizeRoles(['super']);
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
        $profile=new Profile();
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
        $user->profile()->save($profile);
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
    public function DbaShow($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
         $dba=Dba::find($id);   
         return response()->json($dba);
    }
    
    public function DbaSave(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $dba=new Dba();
        $dba->name=$request->name_add;
        $dba->grade_id=$request->grade_add;
        $dba->subject_id=$request->subject_add;
        $dba->save();
        $view = view('super.dba.dba')->with('dba',$dba)->render();
        return response()->json(['data'=>$view,'id'=>"".$dba->id]);
    }
    public function DbaUpdate($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $dba=Dba::find($id);
        $dba->name=$request->name_edit;
        $dba->save();
        return response()->json($dba);
    }
      public function DbaDelete($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
         $dba=Dba::find($id);   
            $dba->delete();
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

    public function QuestionIndex(Request $request)
    {
       $request->user()->authorizeRoles(['super']);
       $questions=Question::all();
       return view('super.question.index', compact('questions')); 
    }
    public function QuestionSave(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $question=new Question();
        $dba=Dba::find($request->id_dba);
        $question->question=$request->text_pregunta;
        $question->a=$request->answer_a;
        $question->b=$request->answer_b;
        $question->c=$request->answer_c;
        $question->d=$request->answer_d;
        $question->correct=$request->answer_correct;
        $question->dba_id=$dba->id;
        $question->subject_id=$dba->subject->id;
        $question->grade_id=$dba->grade->id;
        $question->save();
        $dba=Dba::find($request->id_dba);
        $dba->count=$dba->questions->count();
        return response()->json($dba); 
    }
    public function QuestionShow($id,Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $question=Question::find($id);
        return response()->json($question); 
    }
    public function QuestionSearch(Request $request)
    {
        $request->user()->authorizeRoles(['super']);
        $questions = Question::all();
        $view="";
        if($request->subject!=0 && $request->grade!=0){
        $questions = Question::where([['subject_id', '=', $request->subject],['grade_id', '=', $request->grade]])->get();
        }
        if ($request->subject==0 && $request->grade!=0) {
            $questions = Question::where('grade_id',$request->grade)->get();
        }
        if ($request->subject!=0 && $request->grade==0) {
            $questions = Question::where('subject_id', $request->subject)->get();
        }
        if($request->subject==0 && $request->grade==0){
            $questions = Question::all();
        }
        foreach ($questions as $question) {
            $view = $view.view('super.question.question')->with('question',$question)->render();
        }
        if ($view=="") {
            $view="<br><br><h1>No se encontraron preguntas</h1>";
            return response()->json(['data'=>$view,'count'=>$questions->count()]);
        }
        return response()->json(['data'=>$view,'count'=>$questions->count()]);
    }
public function QuestionUpdate($id,Request $request)
{
    $request->user()->authorizeRoles(['super']);
        $question=Question::find($id);
        $question->question=$request->text_pregunta;
        $question->a=$request->answer_a;
        $question->b=$request->answer_b;
        $question->c=$request->answer_c;
        $question->d=$request->answer_d;
        $question->correct=$request->answer_correct;
        $question->save();
        $view = view('super.question.question')->with('question',$question)->render();
        return response()->json(['data'=>$view,'id'=>"".$question->id]);

}
 public function QuestionDelete($id,Request $request)
  {
      $request->user()->authorizeRoles(['super']);
        $question=Question::find($id);
        $question->delete();
        return response()->json($question); 

  } 
  public function ProfileIndex( Request $request)
  {
     $request->user()->authorizeRoles(['teacher', 'admin','parent','student','coordinator','super']);

        if ($request->user()->hasRole('admin'))
        {
           return view('admin.profile.index');
        }

        else if($request->user()->hasRole('teacher'))
        {          
            return view('teacher.profile.index');
        }

        elseif ($request->user()->hasRole('parent'))
        {
            return view('parent.profile.index');
        } 

        elseif ($request->user()->hasRole('student')) 
        {
            return view('student.profile.index');
        }

        elseif ($request->user()->hasRole('coordinator')) 
        {
            return view('coordinator.profile.index');
        }
        
  }
  public function ProfileUpdate(Request $request)
    {
        $request->user()->authorizeRoles(['admin','teacher','coordinator','student','parent']);
        switch ($request->tipo) {
            case 'name':
            $request->user()->first_name=$request->first_name;
                $request->user()->second_name=$request->second_name;
                $request->user()->name=$request->first_name." ".$request->second_name;
                $request->user()->save();
                return response()->json( $request->user());
                break;
            case 'number':
                $request->user()->profile->phone=$request->number;
                $request->user()->profile->save();
                return "";
                break;
            case 'direction':
                $request->user()->profile->direction=$request->direction;
                $request->user()->profile->save();
                return "";
                break;
            case 'description':
                $request->user()->profile->description=$request->description;
                $request->user()->profile->save();
                return "";
                break;
            case 'password':
                $request->user()->password=bcrypt($request->password);
                $request->user()->save();
                return "";
                break;
            case 'photo':
            if($request->file('photo')){
                $file = $request->file('photo');
                \Storage::disk('logo')->delete($request->user()->profile->avatar);
                $nombre =time() ."_". $file->getClientOriginalName();
                $path = public_path('logo/'.$nombre);
               // \Storage::disk('logo')->put($nombre,  \File::get($file));
                Image::make($file)->fit(150, 150)->save($path);
                $request->user()->profile->avatar=$nombre;
                 $request->user()->profile->save();
                 $request->user()->profile->avatar=$request->user()->profile->getLogoUrl().'?'.uniqid();
                 return response()->json( $request->user()->profile);
            }
                 
                break;
                case 'portada':
            if($request->file('photo')){
                $file = $request->file('photo');
                \Storage::disk('portada')->delete($request->user()->profile->portada);
                $nombre =time() ."_". $file->getClientOriginalName();
               // $path = public_path('portada/'.$nombre);
               \Storage::disk('portada')->put($nombre,  \File::get($file));
                $request->user()->profile->portada=$nombre; 
                $request->user()->profile->save();
                $request->user()->profile->portada=$request->user()->profile->getPortadaUrl().'?'.uniqid();
                return response()->json( $request->user()->profile);
            }
                 
                break;
                
            default:
                break;
        }
       
        return "";
    }
}

