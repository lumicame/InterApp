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

        $user =new User();
        $user->name = 'Administrator';
        $user->email = 'admin@admin.com';
        $user->username="t00000001";
        $user->password = bcrypt('admin');
        $user->save();
        $user->roles()->attach($role_admin);

        $user =new User();
        $user->name = 'Proffesor';
        $user->email = 'teacher@teacher.com';
        $user->username="t00000002";
        $user->password = bcrypt('teacher');
        $user->save();
        $user->roles()->attach($role_teacher);

        $user =new User();
        $user->name = 'Parents';
        $user->email = 'parent@parent.com';
        $user->username="t00000003";
        $user->password = bcrypt('parent');
        $user->save();
        $user->roles()->attach($role_parent);

for ($i=4; $i < 50; $i++) {
        $user =new User();
        $user->name = 'Coordinators '.$i;
        $user->email = 'coordinator'.$i.'@coordinator.com';
        $user->username="t0000000".$i;
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
