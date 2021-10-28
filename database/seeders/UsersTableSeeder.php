<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Administrator
        DB::table('users')->insert([
            'full_name' => 'OdevLAB Admin',
            'username' => 'Samdam',
            'email' => 'odevservices@gmail.com',
            'password' => Hash::make('1111'),
            'role' => 'admin',
            'status' => 'active',
            ]
        );

         //Vendor
         DB::table('users')->insert([
            'full_name' => 'OdevLAB Vendor',
            'username' => 'Vendor',
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('1111'),
            'role' => 'vendor',
            'status' => 'active',
            ]
        );

         //Customer
         DB::table('users')->insert([
            'full_name' => 'OdevLAB Customer',
            'username' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('1111'),
            'role' => 'customer',
            'status' => 'active',
            ]
        );
    }
}
