<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        // $role = new Role();
        // $role->name = 'manager';
        // $role->description = 'Manager';
        // $role->save();

        // $role = new Role();
        // $role->name = 'accountant';
        // $role->description = 'Accountant';
        // $role->save();

        // $role = new Role();
        // $role->name = 'seller';
        // $role->description = 'Seller';
        // $role->save();

        // $role = new Role();
        // $role->name = 'warehouse';
        // $role->description = 'Warehouse';
        // $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'Customer';
        $role->save();
    }
}
