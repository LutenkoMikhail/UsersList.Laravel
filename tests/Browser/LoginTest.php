<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    /** @test */
    public function test_login_admin()
    {
        $this->browse(function ($browser) {
            $browser->visitRoute('login')
                ->type('email', Config::get('constants.admin.email'))
                ->type('password', Config::get('constants.admin.password'))
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
            $browser->loginAs(User::where('email', Config::get('constants.admin.email'))->firstOrFail())
                ->visitRoute('homeAdmin')
                ->assertSee('admin')
                ->logout();
        });
    }

}
