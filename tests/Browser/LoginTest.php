<?php

namespace Tests\Browser;

use App\device_supplier;
use App\deviceSupplier;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;
    protected $listSuppliers;
    protected $deviceSupplier;
    // /**
    //  * Set up the browser test environment.
    //  *
    //  * @return void
    //  */
    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->artisan('db:seed');
    //     $this->deviceSupplier = factory(deviceSupplier::class)->create();
    //     // deviceSupplier::softDeletes();
    //     // $deviceSupplier2 = deviceSupplier::factory()->create(); 
    //     // deviceSupplierFactory::factory()->create();  
    //     info("deviceSupplier");
    //     info($this->deviceSupplier);
    //     // info("List before beginTransaction");
    //     // $ds = deviceSupplier::get();
    //     // // info([$ds]);
    //     // for($idx = 0;$idx < count($ds); $idx ++){
    //     //     info($ds[$idx]);

    //     // }
    // }
    // /**
    //  * A Dusk test example.
    //  * @test
    //  * @group 
    //  * @return void
    //  */
    // public function testExample()
    // {
    //     // $newDS = new deviceSupplier();
    //     // $newDS->name = 'THong';
    //     // $newDS->save();

    //     // $createdDS= deviceSupplier::where('name','=','THong')->first();
    //     // info($createdDS);
    //     // info("List after add");
    //     // $ds = deviceSupplier::get();
    //     // // info([$ds]);
    //     // for($idx = 0;$idx < count($ds); $idx ++){
    //     //     info($ds[$idx]);

    //     // }

    //     // deviceSupplierFactory::
        
    //     // info($deviceSupplier2);
    //     $this->browse(function (Browser $browser) {
    //         // $browser->loginAs(431)
    //         //         ->assertSee('thong');
    //         $browser->visit('/')
    //                 ->type('username','thong_pl')
    //                 ->type('password','ttd123@')
    //                 ->press('Đăng nhập')
    //                 ->waitForText('Trang chủ',30)
    //                 ->screenshot('home')
    //                 ->assertPathIs('/trang-chu');
    //     });
        

       
    // }
    // /**
    //  * @test
    //  * @group UI
    //  */
    // public function addSuccessDeviceSupplier()
    // {
    //     // \DB::beginTransaction();

    //     $name = $this->deviceSupplier->name;
    //     $this->browse(function (Browser $browser) use($name){
    //         $browser->visit('danh-sach-ncc-thiet-bi')
    //                 // ->screenshot('page')
    //                 // ->type('username','thong')
    //                 // ->press('')
    //                 ->assertSee('Danh sách nhà cung cấp thiết bị')
    //                 ->waitUntilMissing('.vld-overlay')
    //                 ->press('Thêm nhà cung cấp thiết bị')
    //                 ->waitFor('.device_supplier_name')
    //                 ->type('.device_supplier_name',$name)
    //                 ->screenshot('afterType')
    //                 ->press('Tạo mới')
    //                 ->waitForText('Thành công')
    //                 ->waitUntilMissing('.vld-overlay')
    //                 ->assertSee($name);
                    
    //     });
    //     $this->deviceSupplier->delete();

    //     // deviceSupplier::where('name','=',$name)->delete();
    //     // \DB::rollBack();

    // }
    public function testExample()
    {
        
    }
}
