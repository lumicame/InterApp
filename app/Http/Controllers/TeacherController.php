<?php

namespace App\Http\Controllers;

use App\School;
use App\Role;
use App\User;
use App\Classroom;
use App\Evaluation;
use App\Question;
use App\Shedule;
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
    public function ClassIndex(Request $request)
    {
      $request->user()->authorizeRoles(['teacher']);
      $shedules=$request->user()->shedules()->inRandomOrder()->get();
      return view('teacher.class.index', compact('shedules')); 
    }

    public function GroupIndex(Request $request)
    {
      $request->user()->authorizeRoles(['teacher']);
      $classrooms=$request->user()->group;
      return view('teacher.group.index', compact('classrooms')); 
    }

    public function GroupStudentIndex($id,Request $request)
    {
      $request->user()->authorizeRoles(['teacher']);
      $classroom=$request->user()->group->find($id);
      $students=$classroom->users()->orderBy('second_name')->get();
      $students->class=$classroom->class." ".$classroom->classroom;
      return view('teacher.group.student.index', compact('students')); 
    }

    public function ClassStudentIndex($id,Request $request)
    {
      $request->user()->authorizeRoles(['teacher']);
      $shedule=$request->user()->shedules->find($id);
      return view('teacher.class.shedule.index', compact('shedule')); 
    }

    public function EvaluationSave(Request $request)
    {
      $request->user()->authorizeRoles(['teacher']);
      $evaluation=new Evaluation();
      $evaluation->name=$request->name;
      $evaluation->shedule_id=$request->shedule_id;
      $evaluation->finish=$request->date;
      $evaluation->estado="inactivo";
      $evaluation->save();
      $shedule=Shedule::find($request->shedule_id);
      $view = view('teacher.class.shedule.evaluation.card')->with(array('evaluation'=>$evaluation, 'shedule'=>$shedule))->render();
      return response()->json(['data'=>$view,'id'=>"".$evaluation->id]);
    }
    public function EvaluationShow($id,Request $request)
    {
      $request->user()->authorizeRoles(['teacher']);
      $evaluation=Evaluation::find($id);
      $view_questions="<h3>".$evaluation->questions->count()." pregunta(s)</h3>";

      if ($evaluation->questions->count()>0) 
      {
       foreach ($evaluation->questions as $question) 
       {
         $view_questions = $view_questions.view('teacher.class.shedule.evaluation.question')->with('question',$question)->render();
       }
     }
     else
     {
      $view_questions="<h3>No hay preguntas</h3>";
    }


    return response()->json(['questions'=>$view_questions,'count'=>$evaluation->questions->count(),'name'=>$evaluation->name,'finish'=>$evaluation->finish,'evaluation_id'=>$evaluation->id]);
  }

  public function EvaluationActivar($id,Request $request)
  {
    $request->user()->authorizeRoles(['teacher']);
    $evaluation=Evaluation::find($id);
    if($evaluation->estado=="inactivo"){
      $evaluation->estado="activo";
    }else{
      $evaluation->estado="inactivo";
    }
    $evaluation->save();
    return response()->json($evaluation);
  }
  public function EvaluationUpdate($id,Request $request)
  {
    $request->user()->authorizeRoles(['teacher']);
    $evaluation=Evaluation::find($id);
    $evaluation->name=$request->name;
    $evaluation->finish=$request->date;
    $evaluation->save();
    return response()->json($evaluation);
  }
  public function EvaluationDelete($id,Request $request)
  {
    $request->user()->authorizeRoles(['teacher']);
    $evaluation=Evaluation::find($id);
    $evaluation->delete();
    return response()->json($evaluation);
  }
  public function EvaluationQuestionSave(Request $request)
  {
    $request->user()->authorizeRoles(['teacher']);
    $question=new Question();
    $question->question=$request->text_pregunta;
    $question->a=$request->answer_a;
    $question->b=$request->answer_b;
    $question->c=$request->answer_c;
    $question->d=$request->answer_d;
    $question->correct=$request->answer_correct;
    $question->evaluation_id=$request->evaluationID;
    $question->save();
    return response()->json($question); 
  }
}
