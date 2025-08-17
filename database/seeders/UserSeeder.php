<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $users = [
        ['name'=>'Ahmed',   'email'=>'ahmed@gmail.com'],
        ['name'=>'Mohamed', 'email'=>'mohamed@gmail.com'],
        ['name'=>'Ali',     'email'=>'ali@gmail.com'],
    ];
    foreach ($users as $u) {
        User::firstOrCreate(
            ['email'=>$u['email']],
            ['name'=>$u['name'], 'password'=>Hash::make('password')]
        );
    }
}
}
