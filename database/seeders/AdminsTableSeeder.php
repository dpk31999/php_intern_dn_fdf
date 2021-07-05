<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'fullname' => 'Dong Huynh',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '0826792146',
            'role' => 'Admin',
        ]);

        Admin::create([
            'fullname' => 'Tuan Tran',
            'email' => 'manager1@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '0826792146',
            'role' => 'Manager',
        ]);
    }
}
