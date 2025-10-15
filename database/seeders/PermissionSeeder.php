<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Permission Create',
            'Permission Show',
            'Permission Edit',
            'Permission Delete',
            'Role Show',
            'Role Create',
            'Role Edit',
            'Role Delete',
            'Asign Permission',

            'Branch Show',
            'Branch Create',
            'Branch Edit',
            'Branch Delete',

            'Brand Show',
            'Brand Create',
            'Brand Edit',
            'Brand Delete',

            'Color Show',
            'Color Create',
            'Color Edit',
            'Color Delete',

            'Company Show',
            'Company Create',
            'Company Edit',
            'Company Delete',

            'Company Show',
            'Company Create',
            'Company Edit',
            'Company Delete',

            'Contact Us Show',
            'Contact Us Delete',

            'Delivery Schedule Show',
            'Delivery Schedule Create',
            'Delivery Schedule Edit',
            'Delivery Schedule Delete',

            'Driver Show',
            'Driver Create',
            'Driver Edit',
            'Driver Delete',

            'Model Show',
            'Model Create',
            'Model Edit',
            'Model Delete',

            'Shop Show',
            'Shop Create',
            'Shop Edit',
            'Shop Delete',

            'System User Show',
            'System User Create',
            'System User Edit',
            'System User Delete',

            'User Show',
            'User Create',
            'User Edit',
            'User Delete',

            'Vehicle Show',
            'Vehicle Create',
            'Vehicle Edit',
            'Vehicle Delete',

            'Vehicle Type Show',
            'Vehicle Type Create',
            'Vehicle Type Edit',
            'Vehicle Type Delete',

            'Employee Show',
            'Employee Create',
            'Employee Edit',
            'Employee Delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }
    }
}
