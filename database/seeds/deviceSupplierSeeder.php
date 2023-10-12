<?php

use App\deviceSupplier;
use Illuminate\Database\Seeder;

class deviceSupplierSeeder extends Seeder
{
    public static $arrryDeviceSupplier = 
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
        ],
        [
            'name' => "TMS solution",
            'code' => "TMSSOLUTION",
            'duration' => 240,
            'creator_id' => 479,
            'company_branch_id' => 138,
            'created_at' => '2022-03-21 15:15:21',
            'updated_at' => '2022-03-21 15:15:21',
            'deleted_at' => NULL,
        ],
        [
            'name' => "TTD coporator",
            'code' => "TTDCOPORATOR",
            'duration' => 300,
            'creator_id' => 479,
            'company_branch_id' => 138,
            'created_at' => '2022-03-21 15:15:21',
            'updated_at' => '2022-03-21 15:15:21',
            'deleted_at' => NULL,
        ]
    ];
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
        
            // deviceSupplier::truncate();
            
        // $latestUser = deviceSupplier::select('id')->orderBy('id', 'DESC')->first();

        deviceSupplier::insert(
            deviceSupplierSeeder::$arrryDeviceSupplier
        );
        // DB::table('users')->insert($multiple_rows);
        
        // deviceSupplier::where('id', '>', $latestUser->id)->delete();
        // $idDeviceSupplier = array_column($arrryDeviceSupplier, 'id');
        
    }
}
