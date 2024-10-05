<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
         \App\Models\Counter::factory(1)->create();
         \App\Models\Product::factory(5)->create();
         \App\Models\Customer::factory(5)->create();
         \App\Models\Invoice::factory(5)->create();
         \App\Models\InvoiceItems::factory(5)->create();
    }
}
