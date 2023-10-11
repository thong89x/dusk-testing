<?php

namespace Tests\Browser;

use App\device_supplier;
use App\deviceSupplier;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\DeviceSupplier as PagesDeviceSupplier;
use Tests\DuskTestCase;

class deviceSupplierTest extends DuskTestCase
{
    protected $listSuppliers;
    protected $deviceSupplier;
    protected $nameDeviceSupplier;
    /**
     * Set up the browser test environment.
     * run seed
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
    /**
     * @test
     * @group CRUD
     * @group search
     * @group basic
     * @group UI
     * @return void
     */
    public function login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('')
                    ->type('username','thong_pl')
                    ->type('password','ttd123@')
                    ->press('Đăng nhập')
                    ->waitForText('Trang chủ',30)
                    ->screenshot('home')
                    ->assertPathIs('/trang-chu');
        });
    }
    /**
     * @test
     * @group UI
     * @return void
     */
    public function checkPlaceholder()
    {
        $arrayClassAndPlaceholder = [
            ['selector'=>'.device_supplier_name','placeholder'=>'Nhập tên nhà cung cấp thiết bị','title'=>'Tên nhà cung cấp thiết bị'],
            ['selector'=>'.device_supplier_duration','placeholder'=>'Nhập thời gian bảo trì','title'=>'Thời gian bảo trì']
        ];
        $this->browse(function (Browser $browser) use($arrayClassAndPlaceholder) {
            $browser->visit(new PagesDeviceSupplier)
                    ->checkPlaceholderOfCreateModal($arrayClassAndPlaceholder);
        });
    }
    /**
     * @test
     * @group CRUD
     */
    public function addDeviceSupplierSuccess()
    {
        // \DB::beginTransaction();
        $deviceSupplier = factory(deviceSupplier::class)->create();
        $this->deviceSupplier = deviceSupplier::find($deviceSupplier->id);
        info("Check deviceSupplier");        

        info($this->deviceSupplier);

        $this->nameDeviceSupplier = $this->deviceSupplier->name;
        // info($this->nameDeviceSupplier);        

        $this->browse(function (Browser $browser){
            $browser->visit('/danh-sach-ncc-thiet-bi')
                    // ->screenshot('page')
                    // ->type('username','thong')
                    // ->press('')
                    ->assertSee('Danh sách nhà cung cấp thiết bị')
                    ->waitUntilMissing('.vld-overlay')
                    ->press('Thêm nhà cung cấp thiết bị')
                    ->waitFor('.device_supplier_name');
            $this->deviceSupplier->delete();
      
            $browser->type('.device_supplier_name',$this->nameDeviceSupplier)
                    ->screenshot('afterType')
                    ->press('Tạo mới')
                    ->waitForText('Thành công')
                    ->waitUntilMissing('.vld-overlay')
                    ->assertSee($this->nameDeviceSupplier);
                    
        });

        // deviceSupplier::where('name','=',$this->nameDeviceSupplier)->delete();
        // \DB::rollBack();

    }
    /**
     * @test
     * @group CRUD
     */
    public function addDeviceSupplierDupplicate()
    {
        // \DB::beginTransaction();
        // $this->nameDeviceSupplier = $this->deviceSupplier->name;
        $this->deviceSupplier = deviceSupplier::where('deleted_at',null)->orderBy('created_at','desc')->first();
        $this->nameDeviceSupplier =  $this->deviceSupplier->name ;

        info("Name duplicate");
        info($this->nameDeviceSupplier);
        $this->browse(function (Browser $browser){
            $browser->visit('/danh-sach-ncc-thiet-bi')
                    ->assertSee('Danh sách nhà cung cấp thiết bị')
                    ->waitUntilMissing('.vld-overlay')
                    ->press('Thêm nhà cung cấp thiết bị')
                    ->waitFor('.device_supplier_name')
                    ->type('.device_supplier_name',$this->nameDeviceSupplier)
                    ->screenshot('afterType')
                    ->press('Tạo mới')
                    ->waitForText('Tên nhà cung cấp thiết bị trùng');
        });

    }

    // public function tearDown(): void
    // {
    //     parent::tearDown();
    //     $this->artisan('db:seed-undo');

    //     // $this->browse(function (Browser $browser) {
    //     //     $browser->driver->manage()->deleteAllCookies();
    //     // });
    // }
}
