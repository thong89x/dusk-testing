<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class DeviceSupplier extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/danh-sach-ncc-thiet-bi';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }
    public function createSupplier(Browser $browser, string $name,float $duration = 0): void
    {
        $browser->press('Thêm nhà cung cấp thiết bị')
                ->waitFor('@nameSupplier')
                ->type('@nameSupplier', $name)
                ->waitFor('@durationSupplier')
                ->type('@durationSupplier', $duration)
                ->press('Tạo mới');
    }
    public function checkPlaceholderOfCreateModal(Browser $browser, $arrayClassAndPlaceholder){
        $browser->press('Thêm nhà cung cấp thiết bị');
        for($idx = 0 ; $idx < count($arrayClassAndPlaceholder); $idx ++){
            $selector = $arrayClassAndPlaceholder[$idx]['selector'];
            $placeholder = $arrayClassAndPlaceholder[$idx]['placeholder'];
            $title = $arrayClassAndPlaceholder[$idx]['title'];
            $browser->waitFor($selector)
                    ->assertPresent($selector)
                    ->waitForText($title)
                    ->assertAttribute($selector,'placeholder', $placeholder );
        }

    }
    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@nameSupplier' => '.device_supplier_name',
            '@durationSupplier' => '.device_supplier_duration',
        ];
    }
}
