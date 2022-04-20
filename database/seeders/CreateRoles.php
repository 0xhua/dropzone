<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = Role::create(['name' => 'seller']);
        $seller->givePermissionTo(
            [
                'item-list',
                'item-create',
                'item-edit',
                'item-delete',
                'request-list',
                'request-create',
                'request-edit',
                'request-delete',
                'item-show-qr'
            ]
        );
        $buyer = Role::create(['name' => 'buyer']);
        $buyer->givePermissionTo('item-list');
        $da = Role::create(['name' => 'da']);
        $da->givePermissionTo(
            [
                'item-list',
                'item-create',
                'item-show-qr',
                'item-transfer',
                'item-receive',
                'request-list'
            ]
        );
    }
}
