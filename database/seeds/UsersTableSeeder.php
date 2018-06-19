<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\School;
use App\Grade;
use App\Subject;
use App\Classroom;
use App\Date;
use App\Shedule;
use Faker\Generator as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {       
        /*Supuer Usuario*/
        $super=Role::where('name','super')->first();
        $count=User::all()->count();
        $user =new User();
        $user->name = 'Super Admin';
        $user->first_name="Super";
        $user->second_name="Admin";
        $user->email = 'super@admin.com';
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('superadmin2018');
        $user->save();
        $user->roles()->attach($super);

        /*Diferentes tipos de roles*/
        $role_admin = Role::where('name', 'admin')->first();
        $role_parent=Role::where('name','parent')->first();
        $role_teacher=Role::where('name','teacher')->first();
        $role_coordinator=Role::where('name','coordinator')->first();       
        $role_student = Role::where('name', 'student')->first();

        /*Grados existentes en la actualidad*/
        for ($i=0; $i <= 11 ; $i++) { 
            $grade=new Grade();
            $grade->name="Grado ".$i."°";
            $grade->grade=$i;
            $grade->save();
        }
        
        /*Escuelas de prueba con sus administradores*/    
        for ($i=0; $i <5 ; $i++) { 
        $school=new School();
        $school->name=$faker->name;
        $school->nit=str_random(12);
        $school->email="utb".$i."@utb.com";
        $school->phone="555555";
        $school->save();

        /*Administrador del colegio*/
        $count=User::all()->count();
        $user =new User();
        $user->name = 'Administrator '.$i;
        $user->first_name="firstname";
        $user->second_name="secondname";
        $user->email = 'admin'.$i.'@admin.com';        
        $user->role_id=$role_admin->id;
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('admin');
        $user->save();
        $user->roles()->attach($role_admin);
        $school->users()->save($user);

        /*Profesor del colegio*/
        $count=User::all()->count();
        $user =new User();
        $user->name = 'Profesor '.$i;
        $user->first_name="firstname";
        $user->second_name="secondname";
        $user->email = 'teacher'.$i.'@teacher.com';        
        $user->role_id=$role_teacher->id;
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('teacher');
        $user->save();
        $user->roles()->attach($role_teacher);
        $school->users()->save($user);

        /*Grado de la clase*/
        $grade=Grade::find(2);

        /*Salon de clases*/
        $classroom = new Classroom();
        $classroom->class = 'Primero A';
        $classroom->classroom = 'Aula 101';
        $classroom->jornada = 'AM';
        $classroom->grade_id=$grade->id;
        $classroom->save();
        $school->classrooms()->save($classroom);
        $subject=new Subject();
        $subject->name="Matematicas";
        $subject->save();
        $school->subjects()->save($subject);

        $date=new App\Date();
        $date->star = '7 am';
        $date->end='8 am';
        $date->day='Martes';
        $date->save();

        $shedule = new Shedule();
        $shedule->subject_id=$subject->id;
        $shedule->classroom_id=$classroom->id;
        $shedule->user_id=$user->id;
        $shedule->save();
        $shedule->dates()->save($date);
        }

        

        //$primeroA=Classroom::where('name','Primero A')->first();
                
        /* 
        for ($i=0; $i < 10; $i++) { 
        $profile=new Profile();
        $profile->name=$faker->name;
        $profile->description=$faker->paragraph;
        $profile->img_monster=$faker->paragraph;
        $user =new User();
        $user->nit = str_random(10);
        $user->name = $faker->name;
        $user->email = $faker->unique()->safeEmail;
        $user->password = bcrypt('student');
        $user->save();
        $user->roles()->attach($role_student);
        $user->classroom()->attach($primeroA);
        $user->profile()->save($profile);
        }*/
    }
}
