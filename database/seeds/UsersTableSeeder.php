<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\School;
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
    	$role_student = Role::where('name', 'student')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_parent=Role::where('name','parent')->first();
        $role_teacher=Role::where('name','teacher')->first();
        $role_coordinator=Role::where('name','coordinator')->first();
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

        for ($i=0; $i <5 ; $i++) { 
        $school=new School();
        $school->name=$faker->name;
        $school->nit=str_random(12);
        $school->email="utb".$i."@utb.com";
        $school->phone="555555";
        $school->save();

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
            for ($e=0; $e <5 ; $e++) { 
                $count=User::all()->count();
                $user =new User();
                $user->name = 'Proffesor '.$e;
                $user->email = $faker->unique()->safeEmail;
                $user->role_id=$role_teacher->id;
                $user->first_name="firstname";
                $user->second_name="secondname";
                $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
                $user->password = bcrypt('teacher');
                $user->save();
                $user->roles()->attach($role_teacher);
                $school->users()->save($user);
            }
        }

        

        //$primeroA=Classroom::where('name','Primero A')->first();
        
        
        
     /*   for ($i=0; $i < 10; $i++) { 
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
