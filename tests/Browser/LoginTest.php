<?php

namespace Tests\Browser;

use App\Profile;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_can_login()
    {
        $profile = factory(Profile::class)->create();
        $password = 'secret';

        $this->browse(function (Browser $browser) use ($profile, $password) {
            $browser->visit(route('login'))
                ->assertSee(__('common.glad_to_see_you_again'))
                ->type('email', $profile->user->email)
                ->type('password', $password)
                ->click('button[type="submit"]');

            $browser->assertAuthenticatedAs($profile->user);
        });
    }

    /** @test */
    public function user_cant_visit_the_login_page()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user);
            $browser->visit(route('login'))->assertUrlIs(route('home') . '/');
        });
    }
}
