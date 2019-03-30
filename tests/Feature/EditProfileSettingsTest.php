<?php

namespace Tests\Feature;

use App\City;
use App\Profile;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditProfileSettingsTest extends TestCase
{
    use DatabaseMigrations;

    /** @var TestCase loggedIn */
    protected $loggedIn;

    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->loggedIn = $this->actingAs($this->user);
    }

    public function sendSettingsForm($params)
    {
        return $this->loggedIn->patch(route('settings.update'), $params);
    }

    /** @test */
    public function can_visit_settings_page()
    {
        $this->loggedIn->get(route('settings.index'))->assertSee($this->user->email);
    }

    /** @test */
    public function cant_update_email_address()
    {
        $this->sendSettingsForm(['email' => 'changed@mail.com'])->assertDontSee($this->user->email);

        $this->assertDatabaseHas('users', ['email' => $this->user->email]);
        $this->assertDatabaseMissing('users', ['email' => 'changed@mail.com']);
    }

    /** @test */
    public function cant_update_password()
    {
        $password = 'not_secret';
        $oldPasswordHash = $this->user->password;

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
        $this->sendSettingsForm(['name' => 'New name']);

        $this->assertDatabaseHas('profiles', ['name' => 'New name']);
    }

    /** @test * */
    public function can_update_surname()
    {
        $this->sendSettingsForm(['surname' => 'New surname']);

        $this->assertDatabaseHas('profiles', ['surname' => 'New surname']);
    }

    /** @test * */
    public function can_update_address()
    {
        $this->sendSettingsForm(['address' => 'New address']);

        $this->assertDatabaseHas('profiles', ['address' => 'New address']);
    }

    /** @test * */
    public function can_update_city()
    {
        $city = factory(City::class)->create();

        $this->sendSettingsForm(['city_id' => $city->id]);

        $this->assertDatabaseHas('users', ['city_id' => $city->id]);
    }

    /** @test * */
    public function can_update_phone()
    {
        $this->sendSettingsForm(['phone' => '+48504623741']);

        $this->assertDatabaseHas('profiles', ['phone' => '+48504623741']);
    }

    /** @test * */
    public function can_upload_avatar()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->sendSettingsForm(['avatar' => $file]);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

        $this->assertDatabaseHas('profiles', [
            'avatar' => 'avatars/' . $file->hashName(),
        ]);

        Storage::disk('public')->deleteDirectory('avatars');
    }

    /** @test */
    public function avatar_should_be_an_image_of_supported_type()
    {
        $this->successfulUpload('jpg');
        $this->successfulUpload('jpeg');
        $this->successfulUpload('png');
        $this->successfulUpload('bmp');

        $this->unsuccessfulUpload('gif');
        $this->unsuccessfulUpload('pdf');
    }

    /** @test * */
    public function avatar_size_should_be_below_2mb()
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.png')->size(2049);

        $this->sendSettingsForm(['avatar' => $file]);

        Storage::disk('public')->assertMissing('avatars/' . $file->hashName());

        $this->assertDatabaseMissing('profiles', [
            'avatar' => 'avatars/' . $file->hashName(),
        ]);

        Storage::disk('public')->deleteDirectory('avatars');
    }

    /** @test * */
    public function can_update_zip()
    {
        $this->sendSettingsForm(['zip' => '01-001']);

        $this->assertDatabaseHas('profiles', ['zip' => '01-001']);
    }

    /** @test * */
    public function can_update_bank_nr()
    {
        $this->sendSettingsForm(['bank_nr' => '90 1090 10412232 1232 1233']);

        $this->assertDatabaseHas('profiles', ['bank_nr' => '90 1090 10412232 1232 1233']);
    }

    /** @test * */
    public function can_update_company_name()
    {
        $this->sendSettingsForm(['company_name' => 'My Company Name']);

        $this->assertDatabaseHas('profiles', ['company_name' => 'My Company Name']);
    }

    /** @test */
    public function can_change_new_offers_notification_preference()
    {
        $this->sendSettingsForm(['notify_new_offer' => true]);

        $this->assertDatabaseHas('profiles', ['notify_new_offer' => true]);
    }

    /** @test */
    public function can_change_new_transactions_notification_preferences()
    {
        $this->sendSettingsForm(['notify_new_transaction' => true]);

        $this->assertDatabaseHas('profiles', ['notify_new_transaction' => true]);
    }

    /** @test */
    public function notify_new_offer_is_false_if_not_supplied()
    {
        $this->sendSettingsForm(['notify_new_offer' => true]);
        $this->sendSettingsForm(['zip' => '01-001']);

        $this->assertDatabaseHas('profiles', ['notify_new_offer' => false]);
    }

    /** @test */
    public function notify_new_transaction_is_false_if_not_supplied()
    {
        $this->sendSettingsForm(['notify_new_transaction' => true]);
        $this->sendSettingsForm(['zip' => '01-001']);

        $this->assertDatabaseHas('profiles', ['notify_new_transaction' => false]);
    }

    /** @test */
    public function notify_new_offer_should_be_set_by_user_during_registration()
    {
        // @TODO
    }

    /** @test */
    public function notify_new_transaction_should_be_set_by_user_during_registration()
    {
        // @TODO
    }

    private function successfulUpload($extension)
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.' . $extension);

        $this->sendSettingsForm(['avatar' => $file]);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

        $this->assertDatabaseHas('profiles', [
            'avatar' => 'avatars/' . $file->hashName(),
        ]);

        Storage::disk('public')->deleteDirectory('avatars');
    }

    private function unsuccessfulUpload($extension)
    {
        Storage::fake('avatars');

        $file = UploadedFile::fake()->image('avatar.' . $extension);

        $this->sendSettingsForm(['avatar' => $file]);

        Storage::disk('public')->assertMissing('avatars/' . $file->hashName());

        $this->assertDatabaseMissing('profiles', [
            'avatar' => 'avatars/' . $file->hashName(),
        ]);

        Storage::disk('public')->deleteDirectory('avatars');
    }
}
