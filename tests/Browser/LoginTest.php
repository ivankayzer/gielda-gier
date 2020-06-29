<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_can_login()
    {
        $user = factory(User::class)->create();
        $password = 'secret';

        $this->browse(function (Browser $browser) use ($user, $password) {
            $browser->visit(route('login'))
                ->assertSee(__('common.glad_to_see_you_again'))
                ->type('email', $user->email)
                ->type('password', $password)
                ->click('button[type="submit"]');

            $browser->assertAuthenticatedAs($user);
        });
    }

    /** @test */
    public function user_cant_visit_the_login_page()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user);
            $browser->visit(route('login'))->assertUrlIs(route('home').'/');
        });
    }
}
