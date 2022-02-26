<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    /** @test */
    public function test_title_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertTitle('Users List');
        });
    }

    /** @test */
    public function test_text_in_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertSee('Users count');
        });
    }

    /** @test */
    public function test_link_in_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertSeeLink("Log in");
        });
    }

    /** @test */
    public function test_login_admin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'admin@admin.com')
                ->type('password', '123456789')
                ->press('Login')
                ->assertPathIs('/admin_panel');
        });
    }

    /** @test */
    public function test_authentication_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/home')
                ->assertSee('Dashboard')
                ->logout();
        });
    }

    /** @test */
    public function test_authentication_admin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', 'admin@admin.com')->firstOrFail())
                ->visit('/admin_panel')
                ->assertSee('admin')
                ->logout();
        });
    }
}
