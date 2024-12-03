<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use App\Models\Role;
use App\Models\JobPosition;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // JobPosition::insert(
        //     [
        //         [
        //             'name' => 'Manager'
        //         ],
        //         [
        //             'name' => 'Developer'
        //         ],
        //         ['name' => 'Designer'],
        //         ['name' => 'Tester']
        //     ]
        // );
        // Role::insert(
        //     [
        //         ['name' => 'Admin'],
        //         ['name' => 'User']
        //     ]

        // );
                Account::insert(
            [
               [
                'mail' =>'user01@gmail.com',
                'full_name' => 'Tran Van A',
                'user_name' => 'user01',
                'phone' => '0123456789',
                'password' => bcrypt('123456'), // mặc định mật khẩu là 'password'
                'role_id' => '1', // Giả sử có từ 1 đến 10 roles
                'job_created_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'job_position_id' => '2',
               ],
               [
                'mail' =>'user02@gmail.com',
                'full_name' => 'Nguyen Thi B',
                'user_name' => 'user02',
                'phone' => '0111222333',
                'password' => bcrypt('123456'), // mặc định mật khẩu là 'password'
                'role_id' => '2', // Giả sử có từ 1 đến 10 roles
                'job_created_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'job_position_id' => '3',
               ]
            ]

        );
    }
}
