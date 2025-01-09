<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $admin =  User::create([
        //     'name' => 'Rizky Cahyono Putra',
        //     'email' => 'rizkycahyonoputra2004@gmail.com',
        //     'password' => Hash::make('test1234'),
        //     'role' => 'admin',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // $admin->assignRole('admin'); // spatie assigment

        // $manager = User::create([
        //     'name' => 'manager',
        //     'email' => 'manager@gmail.com',
        //     'password' => Hash::make('test1234'),
        //     'role' => 'manager',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // $manager->assignRole('manager');

        // $staff = User::create([
        //     'name' => 'staff',
        //     'email' => 'staff@gmail.com',
        //     'password' => Hash::make('test1234'),
        //     'role' => 'staff',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        // $staff->assignRole('staff');

        $staff2 = User::create([
            'name' => 'staff2',
            'email' => 'staff2@gmail.com',
            'password' => Hash::make('test1234'),
            'role' => 'staff',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $staff2->assignRole('staff');
    }
}
