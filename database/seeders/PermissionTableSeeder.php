<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'trainer-list',
            'trainer-create',
            'trainer-edit',
            'trainer-delete',
            'slot-list',
            'slot-create',
            'slot-edit',
            'slot-delete',
            'rtc-list',
            'rtc-create',
            'rtc-edit',
            'rtc-delete',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'student-attendance-list',
            'student-attendance-create',
            'student-attendance-edit',
            'student-attendance-delete',
            'trainer-attendance-list',
            'trainer-attendance-create',
            'trainer-attendance-edit',
            'trainer-attendance-delete',
            'branch-list',
            'branch-create',
            'branch-edit',
            'branch-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission],['name' => $permission]);
        }
    }
}
