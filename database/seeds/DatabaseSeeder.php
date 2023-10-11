<?php

use App\deviceSupplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.x
     *
     * @return void
     */
    public function run()
    {
        $this->call(deviceSupplierSeeder::class);
        
    }
}
