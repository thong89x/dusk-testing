<?php

use App\deviceSupplier;
use Illuminate\Database\Seeder;

class deviceSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // deviceSupplier::factory();  
        // deviceSupplierFactory
        deviceSupplier::truncate();

        deviceSupplier::insert(
            [
                [
                    'name' => "Thông than thở",
                    'code' => "THONGTHANTHO",
                    'duration' => 10,
                    'creator_id' => 479,
                    'company_branch_id' => 138,
                    'created_at' => '2022-03-21 15:15:21',
                    'updated_at' => '2022-03-21 15:15:21',
                    'deleted_at' => NULL,
                ],
                [
                    'name' => "Hậu cự",
                    'code' => "HAUCU",
                    'duration' => 100,
                    'creator_id' => 479,
                    'company_branch_id' => 138,
                    'created_at' => '2022-03-21 15:15:21',
                    'updated_at' => '2022-03-21 15:15:21',
                    'deleted_at' => NULL,
                ]
            ]
        );
    }
}
