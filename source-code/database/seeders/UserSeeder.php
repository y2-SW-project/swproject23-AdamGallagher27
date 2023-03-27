<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin role from role table
        $role_admin = Role::where("name", "admin")->first();

        // user role from roles table
        $role_user = Role::where("name", "user")->first();

        // shop role from roles table
        $role_shop = Role::where("name", "shop")->first();


        // create new admin
        $admin = new User();
        $admin->name = "Admin";
        $admin->email = "admin@gmail.com";
        $admin->password = Hash::make("password");
        $admin->description = 'fdklsjfdlksjfldskjfdlksjf';
        $admin->role_id = $role_admin->id;
        $admin->save();


        // create new user
        $user = new User();
        $user->name = "User";
        $user->email = "user@gmail.com";
        $user->password = Hash::make("password");
        $user->description = 'fdklsjfdlksjfldskjfdlksjf';
        $user->role_id = $role_user->id;
        $user->save();

        // create new shop
        $shop = new User();
        $shop->name = "Shop";
        $shop->email = "shop@gmail.com";
        $shop->password = Hash::make("password");
        $shop->description = 'fdklsjfdlksjfldskjfdlksjf';
        $shop->role_id = $role_shop->id;
        $shop->save();
    }
}
