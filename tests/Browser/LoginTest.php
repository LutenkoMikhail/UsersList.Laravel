<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    /** @test */
    public function test_login_admin()
    {
        $this->browse(function ($browser) {
            $browser->visitRoute('login')
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
                ->visitRoute('home')
                ->assertSee('Dashboard')
                ->logout();
        });
    }

    /** @test */
    public function test_authentication_admin()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', 'admin@admin.com')->firstOrFail())
                ->visitRoute('homeAdmin')
                ->assertSee('admin')
                ->logout();
        });
    }

}
