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


        $this->call(RoleSeeder::class);
        $this->call(VoucherTypeSeeder::class);
        $this->call(ProductSeeder::class);

        \App\Models\Provider::factory(10)->create();
        \App\Models\Customer::factory(10000)->create();
        $this->call(UserSeeder::class);
    }
}
