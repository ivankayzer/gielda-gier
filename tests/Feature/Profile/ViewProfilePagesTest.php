<?php

namespace Tests\Feature\Profile;

use App\Offer;
use App\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewProfilePagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_visit_own_profile_page()
    {
        $user = factory(User::class)->create();
        $user->profile->fill(factory(Profile::class)->make()->toArray())->save();

        $this->actingAs($user)->get(route('profile.me'))
            ->assertSee($user->profile->name)
            ->assertSee($user->profile->surname)
            ->assertSee($user->name)
            ->assertSee($user->city->name);
    }

    /** @test */
    public function guest_cant_visit_own_profile_page()
    {
        $this->get(route('profile.me'))->assertLocation(route('login'));
    }

    /** @test */
    public function anyone_can_visit_other_users_profile_page()
    {
        $user = factory(User::class)->create();
        $otherProfile = factory(Profile::class)->create();

        $this->actingAs($user)->get(route('profile.show', ['user' => $otherProfile->user->name]))
            ->assertDontSee($otherProfile->name)
            ->assertDontSee($otherProfile->surname)
            ->assertSee($otherProfile->user->name)
            ->assertSee($otherProfile->user->city->name);
    }

    /** @test */
    public function can_see_own_offers_on_own_profile_page()
    {
        $user = factory(User::class)->create();
        $unpublishedOffer = factory(Offer::class)->create(['seller_id' => $user->id]);
        $publishedOffer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);
        $this->actingAs($user)->get(route('profile.me'))
            ->assertDontSee($unpublishedOffer->game->title)
            ->assertSee($publishedOffer->game->title);
    }

    /** @test */
    public function can_see_other_users_published_offers_on_their_profile_page()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->state('active')->create(['seller_id' => $user->id]);

        $this->actingAs($secondUser)->get(route('profile.show', ['user' => $user->name]))
            ->assertSee($offer->game->title);
    }

    /** @test */
    public function cant_see_other_users_unpublished_offers_on_their_profile_page()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $offer = factory(Offer::class)->create(['seller_id' => $user->id]);

        $this->actingAs($secondUser)->get(route('profile.show', ['user' => $user->name]))
            ->assertDontSee($offer->game->title);
    }

    /** @test */
    public function can_see_available_offers_section_if_user_has_published_offers()
    {
        $offer = factory(Offer::class)->states(['active', 'user'])->create();

        $this->get(route('profile.show', ['user' => $offer->seller->name]))
            ->assertSee(__('profile.offers'));
    }

    /** @test */
    public function cant_see_available_offers_section_if_user_has_no_published_offers()
    {
        $offer = factory(Offer::class)->states(['user'])->create();

        $this->get(route('profile.show', ['user' => $offer->seller->name]))
            ->assertDontSee(__('profile.offers'));
    }
}
