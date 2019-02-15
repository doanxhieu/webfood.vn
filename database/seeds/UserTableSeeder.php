<?php

use Illuminate\Database\Seeder;
use Sentinel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        // Create Admin Role
        $role1 = [
            'name' => 'Admin',
            'slug' => 'admin',
        ];
        $adminRole = Sentinel::getRoleRepository()->createModel()->fill($role1)->save();

        // Create User Role
        $role2 = [
            'name' => 'User',
            'slug' => 'user',
        ];
        $userRole = Sentinel::getRoleRepository()->createModel()->fill($role2)->save();

        // Create user with admin-role
        $admin_data = [
            //'username' => 'admin',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => '123456',

            "permissions"=> ["admin"=>true,"user"=>false]

        ];

        $admin = Sentinel::registerAndActivate($admin_data);
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($admin);

        // Create user with user-role
        $member_data = [
            //'username' => 'member',
            'first_name' => 'Member',
            'last_name' => '',
            'email'    => 'member@gmail.com',
            'password' => '123456',
            "permissions"=> ["admin"=>true,"user"=>false]
        ];
        $member = Sentinel::registerAndActivate($member_data);
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($member);
    }
}
