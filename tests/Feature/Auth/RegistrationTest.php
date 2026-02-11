<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Livewire\Volt\Volt;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response
            ->assertOk()
            ->assertSeeVolt('pages.auth.register')
            ->assertSee('Register as');
    }

    public function test_new_users_can_register_as_member(): void
    {
        $component = Volt::test('pages.auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 'member');

        $component->call('register');

        $component->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'test@example.com', 'role' => 'member']);
    }

    public function test_new_users_can_register_as_admin_with_valid_code(): void
    {
        Config::set('registration.admin_code', 'admin-secret-123');

        $component = Volt::test('pages.auth.register')
            ->set('name', 'Admin User')
            ->set('email', 'admin@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 'admin')
            ->set('registration_code', 'admin-secret-123');

        $component->call('register');

        $component->assertRedirect(route('admin.dashboard', absolute: false));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'admin@example.com', 'role' => 'admin']);
    }

    public function test_registration_as_admin_fails_with_invalid_code(): void
    {
        Config::set('registration.admin_code', 'admin-secret-123');

        $component = Volt::test('pages.auth.register')
            ->set('name', 'Admin User')
            ->set('email', 'admin@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 'admin')
            ->set('registration_code', 'wrong-code');

        $component->call('register');

        $component->assertHasErrors('registration_code')->assertNoRedirect();

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'admin@example.com']);
    }

    public function test_new_users_can_register_as_librarian_with_valid_code(): void
    {
        Config::set('registration.librarian_code', 'lib-secret-456');

        $component = Volt::test('pages.auth.register')
            ->set('name', 'Librarian User')
            ->set('email', 'librarian@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 'librarian')
            ->set('registration_code', 'lib-secret-456');

        $component->call('register');

        $component->assertRedirect(route('librarian.dashboard', absolute: false));

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'librarian@example.com', 'role' => 'librarian']);
    }

    public function test_registration_as_admin_fails_when_code_not_configured(): void
    {
        Config::set('registration.admin_code', '');

        $component = Volt::test('pages.auth.register')
            ->set('name', 'Admin User')
            ->set('email', 'admin@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 'admin')
            ->set('registration_code', 'any-code');

        $component->call('register');

        $component->assertHasErrors('registration_code')->assertNoRedirect();

        $this->assertGuest();
    }
}
