<?php

namespace Tests\Feature\Auth;

use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function password_is_required_to_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function email_is_required_to_login()
    {
        $response = $this->post(route('login'), [
            'password' => 'secret'
        ]);

        $response->assertSessionHasErrors('email');
    }
}
