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
            'name' => 'Olimpo',
            'email' => 'olimpo@gmail.com',
            'password' => Hash::make('olimpo123'),
            'branch_id' => 1,
        ])->syncRoles(['Olimpo']);
    }
}
