<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Config;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdministratotNewUserTest extends DuskTestCase
{

    /** @test */
    public function test_admin_new_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', 'admin@admin.com')->firstOrFail())
                ->visitRoute('homeAdmin')
                ->visitRoute('user.create')
                ->assertSee('New User')
                ->type('name', Config::get('constants.register.name'))
                ->type('email', Config::get('constants.register.email'))
                ->type('password', Config::get('constants.register.password'))
                ->type('password_confirmation', Config::get('constants.register.password'))
                ->attach('photo', storage_path(Config::get('constants.photo.path_testing_file')))
                ->press('Add User')
                ->assertSee('All Users.')
                ->logout();
        });

        $user = new User();
        $user = $user->where('name', '=', Config::get('constants.register.name'))->first();
        $user->deletePhotoUser($user->photo->photo_path);
        $user->photo()->delete();
        $user->delete();
    }
}
