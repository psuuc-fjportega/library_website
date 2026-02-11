<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <a href="{{ route('books.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>{{ __('Books') }}</a>
                    <span class="mx-1">/</span>
                    <span class="text-gray-900 dark:text-gray-200">{{ __('Details') }}</span>
                </p>
                <h2 class="mt-1 font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $book->title }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $book->author }}</p>
            </div>
            <div class="flex items-center gap-2">
                @can('update', $book)
                    <a href="{{ route('books.edit', $book) }}" wire:navigate>
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-200">
                                    {{ $book->category->name }}
                                </span>
                                @if ($book->available_quantity > 0)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200">
                                        {{ __('Available') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200">
                                        {{ __('Unavailable') }}
                                    </span>
                                @endif
                            </div>

                            @if ($book->description)
                                <div class="mt-6">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Description') }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $book->description }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="lg:col-span-1">
                            <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30 p-5">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Book info') }}</h3>
                                <dl class="mt-4 space-y-4 text-sm">
                                    <div class="flex items-center justify-between gap-4">
                                        <dt class="text-gray-600 dark:text-gray-400">{{ __('Author') }}</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">{{ $book->author }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between gap-4">
                                        <dt class="text-gray-600 dark:text-gray-400">{{ __('Category') }}</dt>
                                        <dd class="font-medium">
                                            <a href="{{ route('categories.show', $book->category) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline" wire:navigate>{{ $book->category->name }}</a>
                                        </dd>
                                    </div>
                                    <div class="flex items-center justify-between gap-4">
                                        <dt class="text-gray-600 dark:text-gray-400">{{ __('Availability') }}</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">{{ $book->available_quantity }}/{{ $book->total_quantity }}</dd>
                                    </div>
                                </dl>

                                @if (auth()->user()->role === 'member' && $book->available_quantity > 0 && auth()->user()->can('create', App\Models\Borrow::class))
                                    <form action="{{ route('borrows.store') }}" method="POST" class="mt-6">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <x-primary-button type="submit" class="w-full justify-center flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                            </svg>
                                            {{ __('Request to borrow') }}
                                        </x-primary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ __('Back to books') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
