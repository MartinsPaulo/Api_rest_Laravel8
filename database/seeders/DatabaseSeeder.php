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
        // $this->call(ProductSeeder::class);
        \App\Models\Product::factory(10)->create();  // Usado quando a model ainda não esta definida
       
    }
}
