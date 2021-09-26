<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
           'name'=>'Seper Admin',
           'email'=>'superadmin@mail.com',
           'password'=>Hash::make('12345678'),
        ]);
        User::create([
            'name'=>'Sub Admin',
            'email'=>'subadmin@mail.com',
            'password'=>Hash::make('12345678'),
        ]);
    }
}
