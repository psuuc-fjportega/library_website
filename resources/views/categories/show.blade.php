<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <a href="{{ route('categories.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>{{ __('Categories') }}</a>
                    <span class="mx-1">/</span>
                    <span class="text-gray-900 dark:text-gray-200">{{ __('Details') }}</span>
                </p>
                <h2 class="mt-1 font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $category->name }}
                </h2>
            </div>
            <div class="flex items-center gap-2">
                @can('update', $category)
                    <a href="{{ route('categories.edit', $category) }}" wire:navigate>
                        <x-primary-button type="button" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            {{ __('Edit') }}
                        </x-primary-button>
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2">
                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30 p-5">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Category summary') }}</h3>
                                <dl class="mt-4 space-y-4 text-sm">
                                    <div class="flex items-center justify-between gap-4">
                                        <dt class="text-gray-600 dark:text-gray-400">{{ __('Name') }}</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">{{ $category->name }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between gap-4">
                                        <dt class="text-gray-600 dark:text-gray-400">{{ __('Slug') }}</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">{{ $category->slug }}</dd>
                                    </div>
                                </dl>
                            </div>

                            @if ($category->description)
                                <div class="mt-6">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Description') }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $category->description }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="lg:col-span-1">
                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Quick actions') }}</h3>
                                <div class="mt-4 space-y-2">
                                    <a href="{{ route('books.index', ['category_id' => $category->id]) }}" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900" wire:navigate>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        {{ __('View books in this category') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ __('Back to categories') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
