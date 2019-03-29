<?php

namespace Tests\Feature;

use App\Profile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditProfileSettingsTest extends TestCase
{
    use DatabaseMigrations;

    /** @var TestCase user */
    protected $user;

    protected $profile;

    protected function setUp()
    {
        parent::setUp();

        $this->profile = factory(Profile::class)->state('withUser')->create();

        $this->user = $this->actingAs($this->profile->user);
    }

    public function sendSettingsForm($params)
    {
        return $this->user->post(route('settings.update'), $params);
    }

    /** @test */
    public function can_visit_settings_page()
    {
        $this->user->get(route('settings.index'))->assertSee($this->profile->user->email);
    }

    /** @test */
    public function guest_cant_visit_settings_page()
    {
        $this->get(route('settings.index'))->assertDontSee($this->profile->user->email);
    }

    /** @test */
    public function cant_update_email_address()
    {
        $this->sendSettingsForm(['email' => 'changed@mail.com'])->assertDontSee($this->profile->user->email);

        $this->assertDatabaseHas('users', ['email' => $this->profile->user->email]);
        $this->assertDatabaseMissing('users', ['email' => 'changed@mail.com']);
    }

    /** @test */
    public function cant_update_password()
    {
        $password = 'not_secret';
        $oldPasswordHash = $this->profile->user->password;

        $this->sendSettingsForm(['password' => $password, 'password_confirmation']);
        $this->assertDatabaseHas('users', ['password' => $oldPasswordHash]);
        $this->assertDatabaseMissing('users', ['password' => bcrypt($password)]);

        $this->sendSettingsForm(['password' => $password]);
        $this->assertDatabaseHas('users', ['password' => $oldPasswordHash]);
        $this->assertDatabaseMissing('users', ['password' => bcrypt($password)]);
    }

    /** @test * */
    public function can_update_description()
    {
        $this->sendSettingsForm(['description' => 'New description']);

        $this->assertDatabaseHas('profiles', ['description' => 'New description']);
    }

    /** @test * */
    public function can_update_name()
    {

    }

    /** @test * */
    public function can_update_surname()
    {

    }

    /** @test * */
    public function can_update_address()
    {

    }

    /** @test * */
    public function can_update_city()
    {

    }

    /** @test * */
    public function can_update_phone()
    {

    }

    /** @test */
    public function phone_shoul_be_formatted()
    {

    }

    /** @test * */
    public function can_upload_avatar()
    {

    }

    /** @test * */
    public function avatar_should_be_an_image()
    {

    }

    /** @test * */
    public function avatar_size_should_be_below_2mb()
    {

    }

    public function zip_should_be_formatted()
    {

    }

    /** @test * */
    public function can_update_zip()
    {

    }

    /** @test * */
    public function can_update_bank_nr()
    {

    }

    /** @test */
    public function bank_nr_should_be_numeric()
    {

    }

    /** @test * */
    public function can_update_company_name()
    {

    }

    /** @test */
    public function can_change_new_offers_notification_preference()
    {

    }

    /** @test */
    public function can_change_new_transactions_notification_preferences()
    {

    }

    /** @test */
    public function notify_new_offer_should_be_set_by_user_during_registration()
    {

    }

    /** @test */
    public function notify_new_transaction_should_be_set_by_user_during_registration()
    {

    }
}
