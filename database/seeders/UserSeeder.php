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

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'branch_id' => 1,
        ])->syncRoles(['Admin']);

        User::create([
            'name' => 'Vendedor 1',
            'email' => 'vendedor1@gmail.com',
            'password' => Hash::make('vendedor1'),
            'branch_id' => 1,
        ])->syncRoles(['Vendedor']);

        User::create([
            'name' => 'Vendedor 2',
            'email' => 'vendedor2@gmail.com',
            'password' => Hash::make('vendedor2'),
            'branch_id' => 1,
        ])->syncRoles(['Vendedor']);

        User::create([
            'name' => 'Cajero 1',
            'email' => 'cajero1@gmail.com',
            'password' => Hash::make('cajero1'),
            'branch_id' => 1,
        ])->syncRoles(['Cajero']);
    }
}
