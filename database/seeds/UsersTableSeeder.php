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
use App\Dba;
use App\Profile;
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
        $profile=new Profile();
        $user->name = 'Super Admin';
        $user->first_name="Super";
        $user->second_name="Admin";
        $user->email = 'super@admin.com';
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('superadmin2018');
        $user->save();
        $user->roles()->attach($super);
        $user->profile()->save($profile);

        /*Grados existentes en la actualidad*/
        for ($i=0; $i <= 11 ; $i++) { 
            $grade=new Grade();
            $grade->name="Grado ".$i."°";
            $grade->grade=$i;
            $grade->save();
        }
        
        /*Escuelas de prueba con sus administradores*/    
       

        

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
