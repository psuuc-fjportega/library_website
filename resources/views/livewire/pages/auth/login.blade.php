<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use function Livewire\Volt\state;

layout('layouts.guest');

form(LoginForm::class);

state(['expectedRole' => match (request()->route()->getName() ?? '') {
    'admin.login' => 'admin',
    'librarian.login' => 'librarian',
    default => 'member',
}]);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    $user = Auth::user();
    if ($user->role !== $this->expectedRole) {
        Auth::logout();
        throw ValidationException::withMessages([
            'form.email' => __('This login is for :role only. Please use the correct login page.', ['role' => ucfirst($this->expectedRole)]),
        ]);
    }

    Session::regenerate();

    $dashboardRoute = $user->dashboardRouteName();

    // Use a full redirect so the layout (including navbar) is re-rendered correctly after login.
    $this->redirectIntended(default: route($dashboardRoute, absolute: false));
};

?>

<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
                @if($expectedRole === 'admin') {{ __('Admin Login') }}
                @elseif($expectedRole === 'librarian') {{ __('Librarian Login') }}
                @else {{ __('Member Login') }}
                @endif
            </h1>
            <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full
                @if($expectedRole === 'admin') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200
                @elseif($expectedRole === 'librarian') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200
                @else bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200 @endif">
                {{ ucfirst($expectedRole) }}
            </span>
        </div>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Sign in to access your dashboard and tools.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-4">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300" wire:navigate>
                    {{ __('Register') }}
                </a>
            </p>
        @endif
    </form>
</div>
