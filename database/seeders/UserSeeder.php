<?php

namespace Database\Seeders;

use App\Models\User;
use illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        User::create([
            'name'=>'Yusak Livingstone',
            'username'=>'moluccas192',
            'nim'=>'672016298',
            'progdi'=>'1',
            'level'=>'TU',
            'email'=>'moluccas192@gmail.com',
            'password'=>bcrypt('admin123'),
            'remember_token'=>Str::random(60),
        ]);
    }
}
