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
        \App\Models\Customer::factory(100)->create();
        $this->call(UserSeeder::class);
        $this->call(CurrencyExchangeSeeder::class);

        //\App\Models\Product::factory(3000)->create();
        //\App\Models\BranchProduct::factory(9000)->create();
    }
}
