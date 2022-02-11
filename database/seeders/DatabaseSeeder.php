<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Provider;
use App\Models\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
        Storage::deleteDirectory('public/assemblies');
        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/assemblies');
        Storage::makeDirectory('public/products');

        $this->call(RoleSeeder::class);
        $this->call(VoucherTypeSeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(UbigeeSeeder::class);

        // Provider::factory(10)->create();

        // Customer::factory(50)->customerWithDni()->create();
        // Customer::factory(50)->customerWithRuc()->create();

        $this->call(UserSeeder::class);
        $this->call(CurrencyExchangeSeeder::class);

        //Sale::factory(1000)->create();

        //\App\Models\Product::factory(3000)->create();
        //\App\Models\BranchProduct::factory(9000)->create();
    }
}
