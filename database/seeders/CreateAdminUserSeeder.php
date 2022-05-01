<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
//        $user = User::create([
//            'name' => 'Joshua Lictan',
//            'email' => 'huatong@dz.com',
//            'password' => bcrypt('secret123')
//        ]);
//
//        @$role = Role::create(['name' => 'Admin']);
//
//        $permissions = Permission::pluck('id','id')->all();
//
//        $role->syncPermissions($permissions);
//
//        $user->assignRole([$role->id]);

        $user = User::findOrFail(0);
        $user->name = 'Sheantel Claveria';
        $user->email = 'sheantel@dz.com';
        $user->save();
    }
}
