<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
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


        //$primeroA=Classroom::where('name','Primero A')->first();
        $count=User::all()->count();
        $user =new User();
        $user->name = 'Administrator';
         $user->first_name="firstname";
        $user->second_name="secondname";
        $user->email = 'admin@admin.com';
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('admin');
        $user->save();
        $user->roles()->attach($role_admin);

$count=User::all()->count();
        $user =new User();
        $user->name = 'Proffesor';
        $user->email = 'teacher@teacher.com';
         $user->first_name="firstname";
        $user->second_name="secondname";
                $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('teacher');
        $user->save();
        $user->roles()->attach($role_teacher);

$count=User::all()->count();
        $user =new User();
        $user->name = 'Parents';
         $user->first_name="firstname";
        $user->second_name="secondname";
        $user->email = 'parent@parent.com';
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('parent');
        $user->save();
        $user->roles()->attach($role_parent);

for ($i=4; $i < 20; $i++) {
    $count=User::all()->count();
        $user =new User();
        $user->name = 'Coordinators '.$i;
         $user->first_name="firstname".$i;
        $user->second_name="secondname".$i;
        $user->email = 'coordinator'.$i.'@coordinator.com';
        $user->username="T".str_pad($count, 8, "0",STR_PAD_LEFT);
        $user->password = bcrypt('coordinator');
        $user->save();
        $user->roles()->attach($role_coordinator);
 }
        
        
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
