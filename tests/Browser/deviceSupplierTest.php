<?php

namespace Tests\Browser;

use App\device_supplier;
use App\deviceSupplier;
use deviceSupplierSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\DeviceSupplier as PagesDeviceSupplier;
use Tests\DuskTestCase;

class deviceSupplierTest extends DuskTestCase
{
    use RefreshDatabase;
    protected $listSuppliers;
    protected $deviceSupplier;
    protected $nameDeviceSupplier;
    protected $lastId;

    // public static function setUpBeforeClass(): void
    // {
    //     // info("deviceSupplierTest: setUpBeforeClass before parent");
    //     // $self::log("deviceSupplierTest: setUpBeforeClass before parent");
    //     // \log::info("deviceSupplierTest: setUpBeforeClass before parent");
    //     parent::setUpBeforeClass();  
    //     // info("deviceSupplierTest: setUpBeforeClass after parent");
    //     // Custom setup code that runs once for the class
    // }
    
    /**
     * Set up the browser test environment.
     * run seed
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $lastSupplier = deviceSupplier::select('id')->orderBy('id', 'DESC')->first();
        info($lastSupplier);
        $this->lastId = 0;
        if($lastSupplier){
            $this->lastId = $lastSupplier->id;
        }
        $this->afterApplicationCreated(function () {
            info("deviceSupplierTest: afterApplicationCreated ");
            
        });
        $this->artisan('db:seed');
        $this->beforeApplicationDestroyed(function () {
            info("deviceSupplierTest: beforeApplicationDestroyed");
        });
    }
   
    // protected function beforeEach()
    // {
    //     // Custom setup code here
    //     info("deviceSupplierTest: beforeEach ");

    // }
    protected function before()
    {
        info("deviceSupplierTest: before Login");

    }
    /**
     * @test
     * @group CRUD
     * @group search
     * @group basic
     * @group UI
     * @group search_special
     * @return void
     */
    public function login()
    {   
        info("deviceSupplierTest: Login");

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
            // ['selector'=>'.device_supplier_duration','placeholder'=>'Nhập thời gian bảo trì','title'=>'Thời gian bảo trì']
        ];
        $this->browse(function (Browser $browser) use($arrayClassAndPlaceholder) {
            $browser->visit(new PagesDeviceSupplier)
                    ->waitUntilMissing('.vld-overlay')
                    ->press('.btn-create')
                    ->checkPlaceholderOfModal($arrayClassAndPlaceholder);
        });
    }
    /**
     * @test
     * @group search
     * @return void
     */
    public function checkPlaceholderModalSearch()
    {
        $arrayClassAndPlaceholder = [
            ['selector'=>'#search_code','placeholder'=>'Nhập mã nhà cung cấp thiết bị','title'=>'Mã nhà cung cấp thiết bị'],
            ['selector'=>'#search_name','placeholder'=>'Nhập tên nhà cung cấp thiết bị','title'=>'Tên nhà cung cấp thiết bị'],
            ['selector'=>'#search_user','placeholder'=>'Nhập người tạo','title'=>'Người tạo'],
        ];
        $this->browse(function (Browser $browser) use($arrayClassAndPlaceholder) {
            $browser->visit(new PagesDeviceSupplier)
                    ->waitUntilMissing('.vld-overlay')
                    ->press('.search-button')
                    ->checkPlaceholderOfModal($arrayClassAndPlaceholder);
        });
    }
    /**
     * @test
     * @group search
     * @return void
     */
    public function searchExitsElementByCode()
    {
        $arrryDeviceSupplier = deviceSupplierSeeder::$arrryDeviceSupplier;
        for($idx=0; $idx<count($arrryDeviceSupplier);$idx ++){
            $currentDeviceSupplier = $arrryDeviceSupplier[$idx];
            $code =  $currentDeviceSupplier['code'];
            $name = "";
            $creator = "";
            $this->browse(function (Browser $browser) use($code,$name,$creator) {
                $browser->visit(new PagesDeviceSupplier)
                        ->waitUntilMissing('.vld-overlay')
                        // ->click('.search-button')
                        ->searchSupplier($code,$name,$creator)
                        ->waitUntilMissing('.vld-overlay');
            });
        }
    }
    /**
     * @test
     * @group search
     * @return void
     */
    public function searchNonExitsByCode()
    {
        $arrryDeviceSupplier = deviceSupplierSeeder::$arrryDeviceSupplier;
        // $names = array_column($arrryDeviceSupplier, 'name');
        $deviceSupplier = factory(deviceSupplier::class)->create();

        $code =  $deviceSupplier->code;
        $name = "";
        $creator = "";
        $deviceSupplier->delete(); 
        
        $this->browse(function (Browser $browser) use($code,$name,$creator) {
            $browser->visit(new PagesDeviceSupplier)
                    ->waitUntilMissing('.vld-overlay')
                    // ->click('.search-button')
                    ->searchSupplier($code,$name,$creator)
                    ->waitUntilMissing('.vld-overlay')
                    ->assertSee('Không có dữ liệu tìm kiếm');
        });
    }
    /**
     * @test
     * @group search
     * @group search_special
     * @return void
     */
    public function searchSupplierBySpecialCode()
    {
        $strError = '%_';
        $stringSpecial = "%`~!@#$^&*()+-=}{][;:/?.>,<|\\'";
        for($idx = 0 ;$idx < strlen($stringSpecial) ;$idx++){
            $code = $stringSpecial[$idx];
            $name = "";
            $creator = "";
            info("code");
            info($code);
            $this->browse(function (Browser $browser) use($code,$name,$creator) {
                $browser->visit(new PagesDeviceSupplier)
                        ->waitUntilMissing('.vld-overlay')
                        // ->click('.search-button')
                        ->searchSupplier($code,$name,$creator)
                        ->waitUntilMissing('.vld-overlay')
                        ->assertSee('Không có dữ liệu tìm kiếm');
            });
        }
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

        // $this->nameDeviceSupplier = $this->deviceSupplier->name;
        // $duration =  $this->deviceSupplier->duration;
        $duration =  0;
        $nameDeviceSupplier = $this->deviceSupplier->name;
        $this->deviceSupplier->delete();

        // info($this->nameDeviceSupplier);        

        $this->browse(function (Browser $browser) use($duration,$nameDeviceSupplier){
            $browser->visit(new PagesDeviceSupplier)
                    ->assertSee('Danh sách nhà cung cấp thiết bị')
                    ->waitUntilMissing('.vld-overlay')
                    ->createSupplier($nameDeviceSupplier,$duration)
                    ->waitForText('Thành công')
                    ->waitUntilMissing('.vld-overlay')
                    ->assertSee($nameDeviceSupplier);
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

    public function tearDown(): void
    {
        info("deviceSupplierTest: tearDown");
        parent::tearDown();
        deviceSupplier::where('id', '>',$this->lastId)->delete();
        
        // $this->browse(function (Browser $browser) {
        //     // $browser->driver->manage()->deleteAllCookies();
        // });
    }
    
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }
    // protected function after()
    // {
    //     info("deviceSupplierTest: after");

    //     // Custom teardown code here
    // }
    // protected function afterEach()
    // {
    //     info("deviceSupplierTest: afterEach");
    //     // Custom teardown code here
    // }
}
