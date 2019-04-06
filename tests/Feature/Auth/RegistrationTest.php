<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function username_is_required_to_register()
    {
        $response = $this->post(route('register'), [
            'city' => '1',
            'email' => 'test@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function email_is_required_to_register()
    {
        $response = $this->post(route('register'), [
            'city' => '1',
            'name' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function city_is_required_to_register()
    {
        $response = $this->post(route('register'), [
            'email' => 'test@example.com',
            'name' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response->assertSessionHasErrors('city');
    }

    /** @test */
    public function password_is_required_to_register()
    {
        $response = $this->post(route('register'), [
            'email' => 'test@example.com',
            'name' => 'test',
            'city' => '1',
            'password_confirmation' => 'secret',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_confirmation_is_required_to_register()
    {
        $response = $this->post(route('register'), [
            'email' => 'test@example.com',
            'name' => 'test',
            'password' => 'secret',
            'city' => '1',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_confirmation_should_be_same_as_password_to_register()
    {
        $response = $this->post(route('register'), [
            'email' => 'test@example.com',
            'name' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret123',
            'city' => '1',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function city_is_stored_in_profile_table()
    {
        $this->post(route('register'), [
            'email' => 'test@example.com',
            'name' => 'test',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'city' => '1',
        ]);

        $this->assertDatabaseHas('users', [
            'city_id' => '1'
        ]);
    }
}
