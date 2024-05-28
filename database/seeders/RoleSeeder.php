<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'admin';
        $roleAdmin->save();

        $roleTeacher = new Role();
        $roleTeacher->name = 'teacher';
        $roleTeacher->save();

        $roleStudent = new Role();
        $roleStudent->name = 'student';
        $roleStudent->save();
    }
}
