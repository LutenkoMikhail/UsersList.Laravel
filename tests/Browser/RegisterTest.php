<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{

    /** @test */
    public function test_user_register_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->assertSee('Register');
        });
    }

    /** @test */
    public function test_user_register()
    {
        $this->browse(function ($browser) {
            $browser->visitRoute('register')
                ->type('name', Config::get('constants.register.name'))
                ->type('email', Config::get('constants.register.email'))
                ->type('password', Config::get('constants.register.password'))
                ->type('password_confirmation', Config::get('constants.register.password'))
                ->attach('photo', storage_path(Config::get('constants.photo.path_testing_file')))
                ->press('Register')
                ->assertSee('Dashboard')
                ->logout();
        });

        $user = new User();
        $user = $user->where('name', '=', Config::get('constants.register.name'))->first();
        $user->deletePhotoUser($user->photo->photo_path);
        $user->photo()->delete();
        $user->delete();
    }
}
