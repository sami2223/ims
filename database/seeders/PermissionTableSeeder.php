<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; 

class PermissionTableSeeder extends Seeder

{

    public function run()

    {

        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'student-list',
           'student-create',
           'student-edit',
           'student-delete',
           'course-list',
           'course-create',
           'course-edit',
           'course-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'gradeSystem-list',
           'gradeSystem-create',
           'gradeSystem-edit',
           'gradeSystem-delete',
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
           'batch-list',
           'batch-create',
           'batch-edit',
           'batch-delete',
           'applicant-list',
           'applicant-create',
           'applicant-edit',
           'applicant-delete',
           'session-list',
           'session-create',
           'session-edit',
           'session-delete'
        ];

     

        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }

}
