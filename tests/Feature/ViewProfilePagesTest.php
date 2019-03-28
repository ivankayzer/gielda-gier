<?php

namespace Tests\Feature;

use App\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProfilePagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_visit_own_profile_page()
    {
        $profile = factory(Profile::class)->state('withUser')->create();

        $this->actingAs($profile->user)->get(route('profile.me'))
            ->assertSee($profile->name)
            ->assertSee($profile->surname)
            ->assertSee($profile->user->name)
            ->assertSee($profile->city->name);
    }

    /** @test */
    public function guest_cant_visit_own_profile_page()
    {
        $this->get(route('profile.me'))->assertLocation(route('login'));
    }

    /** @test */
    public function anyone_can_visit_other_users_profile_page()
    {
        $profile = factory(Profile::class)->state('withUser')->create();
        $otherProfile = factory(Profile::class)->state('withUser')->create();

        $this->actingAs($profile->user)->get(route('profile.show', ['user' => $otherProfile->user->name]))
            ->assertDontSee($otherProfile->name)
            ->assertDontSee($otherProfile->surname)
            ->assertSee($otherProfile->user->name)
            ->assertSee($otherProfile->city->name);
    }
}
