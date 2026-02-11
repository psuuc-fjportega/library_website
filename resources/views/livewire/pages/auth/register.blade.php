<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => '',
    'role' => 'member',
    'registration_code' => '',
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
    'role' => ['required', 'in:member,librarian,admin'],
    'registration_code' => ['nullable', 'required_if:role,admin,librarian', 'string'],
]);

$register = function (): void {
    $this->validate();

    if (in_array($this->role, ['admin', 'librarian'], true)) {
        if ($this->role === 'admin') {
            if (config('registration.admin_code') === '') {
                $this->addError('registration_code', __('Registration as admin is currently disabled.'));
                return;
            }
            if ($this->registration_code !== config('registration.admin_code')) {
                $this->addError('registration_code', __('The admin registration code is invalid.'));
                return;
            }
        }
        if ($this->role === 'librarian') {
            if (config('registration.librarian_code') === '') {
                $this->addError('registration_code', __('Registration as librarian is currently disabled.'));
                return;
            }
            if ($this->registration_code !== config('registration.librarian_code')) {
                $this->addError('registration_code', __('The librarian registration code is invalid.'));
                return;
            }
        }
    }

    $validated = $this->only(['name', 'email', 'password', 'role']);
    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route($user->dashboardRouteName(), absolute: false), navigate: true);
};

?>

<div>
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('Create an account') }}</h1>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Register as a member by default. Staff roles require a registration code.') }}
        </p>
    </div>

    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Register as')" />
            <select wire:model="role" id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                <option value="member">{{ __('Member') }}</option>
                <option value="librarian">{{ __('Librarian') }}</option>
                <option value="admin">{{ __('Admin') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        @if(in_array($role, ['admin', 'librarian']))
            <!-- Registration code (required for Admin / Librarian) -->
            <div class="mt-4 rounded-lg border border-amber-200 dark:border-amber-800 bg-amber-50/70 dark:bg-amber-900/10 p-4">
                <x-input-label for="registration_code" :value="__('Registration code')" />
                <x-text-input wire:model="registration_code" id="registration_code" class="block mt-1 w-full" type="password" name="registration_code" autocomplete="off" placeholder="{{ __('Enter the secret code') }}" />
                <p class="mt-2 text-sm text-amber-800 dark:text-amber-200">{{ __('A secret code is required to register as :role.', ['role' => ucfirst($role)]) }}</p>
                <x-input-error :messages="$errors->get('registration_code')" class="mt-2" />
            </div>
        @endif

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6 space-y-4">
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>

            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                {{ __('Already registered?') }}
                <a class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300" href="{{ route('login') }}" wire:navigate>
                    {{ __('Log in') }}
                </a>
            </p>
        </div>
    </form>
</div>
