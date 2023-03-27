<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new Role;
        $user->name = 'user';
        $user->save();

        $shop = new Role;
        $shop->name = 'shop';
        $shop->save();

        $admin = new Role;
        $admin->name = 'admin';
        $admin->save();
    }
}
