<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'surname' => 'Jodhani',
            'name' => 'Apexa',
            'father_name' => 'Dhirubhai',
            'contact' => '75729 01278',
            'user_profile' => 'assets/img/pngImage.png',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('z'),
            'type' => 0,
            'branch_id' => 0
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
