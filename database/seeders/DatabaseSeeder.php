<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SebastianBergmann\Type\VoidType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // suscursales

        \App\Models\Branch::factory(3)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VoucherTypeSeeder::class);

        
    }
}
