<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <a href="{{ route('books.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>{{ __('Books') }}</a>
                <span class="mx-1">/</span>
                <a href="{{ route('books.show', $book) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>{{ $book->title }}</a>
                <span class="mx-1">/</span>
                <span class="text-gray-900 dark:text-gray-200">{{ __('Edit') }}</span>
            </p>
            <h2 class="mt-1 font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Book') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Update book details and availability') }}</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block mt-1 w-full" :value="old('title', $book->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" class="block mt-1 w-full" :value="old('author', $book->author)" required />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id', $book->category_id) == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500">{{ old('description', $book->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="total_quantity" :value="__('Total quantity')" />
                            <x-text-input id="total_quantity" name="total_quantity" type="number" min="1" class="block mt-1 w-full" :value="old('total_quantity', $book->total_quantity)" required />
                            <x-input-error :messages="$errors->get('total_quantity')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="available_quantity" :value="__('Available quantity')" />
                            <x-text-input id="available_quantity" name="available_quantity" type="number" min="0" class="block mt-1 w-full" :value="old('available_quantity', $book->available_quantity)" required />
                            <x-input-error :messages="$errors->get('available_quantity')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Update Book') }}
                            </x-primary-button>
                            <a href="{{ route('books.show', $book) }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400" wire:navigate>{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
