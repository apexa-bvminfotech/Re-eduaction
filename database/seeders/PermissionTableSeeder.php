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

            'slot-list',
            'slot-create',
            'slot-edit',

            'rtc-list',
            'rtc-create',
            'rtc-edit',

            'course-list',
            'course-create',
            'course-edit',

            'role-list',
            'role-create',
            'role-edit',

            'student-list',
            'student-create',
            'student-edit',
            'student-regular-trainer',
            'student-assign-proxy-trainer',
            'student-approved-leave',
            'student-status-change',
            'student-course-start ',
            'student-course-end',
            'student-proxy-staff-edit',
            'student-regular-staff-edit',
            'student-approved-leave-edit',
            'student-appreciation-edit',

            'student-attendance-list',
            'student-attendance-create',
            'student-attendance-edit',

            'student-PTM-list',
            'student-PTM-create',
            'student-PTM-edit',

            'appreciation-list',
            'appreciation-create',
            'appreciation-edit',

            'trainer-attendance-list',
            'trainer-attendance-create',
            'trainer-attendance-edit',

            'branch-list',
            'branch-create',
            'branch-edit',

            'user-list',
            'user-create',
            'user-edit',

            'course-material-list',
            'course-material-create',
            'course-material-edit',

            'trainer-wise-student-Rtc-slot-report',
            'course-wise-student-report',
            'student-list-report',
            'pending-appreciation-student-list-report',
            'pending-course-student-list-report',
            'student-list-with-course-detail-report',
            'pending-counselling-student-list-report',
            'pending-material-list-student-list-report',
            'student-status-list-report',

            'student-dashboard'
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission],['name' => $permission]);
        }
    }
}
