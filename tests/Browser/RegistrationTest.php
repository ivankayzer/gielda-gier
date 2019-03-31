<?php

namespace Tests\Browser;

use App\City;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskBrowser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_can_register()
    {
        $user = factory(User::class)->make();
        $city = factory(City::class)->create();
        $password = 'secret';

        $this->browse(function (DuskBrowser $browser) use ($user, $city, $password) {
            $browser->visit(route('register'))
                ->assertSee(__('auth.register'))
                ->type('name', $user->name)
                ->type('email', $user->email)
                ->select2('cities', $city->name)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->click('button[type="submit"]');

            $this->assertDatabaseHas('users', [
                'email' => $user->email
            ]);
        });
    }

    /** @test */
    public function user_cant_visit_the_registration_page()
    {
        $user = factory(User::class)->create();

        $this->browse(function (DuskBrowser $browser) use ($user) {
            $browser->loginAs($user);
            $browser->visit(route('register'))->assertUrlIs(route('home') . '/');
        });
    }
}
