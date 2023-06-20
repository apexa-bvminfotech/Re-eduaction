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
            'staff-list',
            'staff-create',
            'staff-edit',
            'staff-delete',
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
            'staff-attendance-list',
            'staff-attendance-create',
            'staff-attendance-edit',
            'staff-attendance-delete',
            'trainer-list',
            'trainer-create',
            'trainer-edit',
            'trainer-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
