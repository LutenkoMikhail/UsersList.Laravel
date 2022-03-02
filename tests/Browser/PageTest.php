<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageTest extends DuskTestCase
{
    /** @test */
    public function test_title_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('welcome');
            $browser->assertTitle('Users List');
        });
    }

    /** @test */
    public function test_text_in_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('welcome');
            $browser->assertSee('Users count');
        });
    }

    /** @test */
    public function test_link_in_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('welcome');
            $browser->assertSeeLink("Log in");
        });
    }

}
