<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Reports & Analytics') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Library statistics and insights') }}
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 p-6 shadow-lg">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="rounded-lg bg-white/20 p-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-white/90">{{ __('Total borrows') }}</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $borrowStats['total'] }}</p>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 shadow-lg">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="rounded-lg bg-white/20 p-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-white/90">{{ __('Pending') }}</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $borrowStats['pending'] }}</p>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 shadow-lg">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="rounded-lg bg-white/20 p-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-white/90">{{ __('Approved') }}</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $borrowStats['approved'] }}</p>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-red-500 to-red-600 p-6 shadow-lg">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="rounded-lg bg-white/20 p-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-white/90">{{ __('Rejected') }}</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $borrowStats['rejected'] }}</p>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-green-500 to-green-600 p-6 shadow-lg">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-2">
                            <div class="rounded-lg bg-white/20 p-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-medium text-white/90">{{ __('Returned') }}</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $borrowStats['returned'] }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            {{ __('Most borrowed books') }}
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($mostBorrowed->isEmpty())
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('No data yet.') }}</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($mostBorrowed as $index => $item)
                                    <div class="py-3 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-900/50 rounded-lg px-2 -mx-2 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                                {{ $index + 1 }}
                                            </div>
                                            <a href="{{ route('books.show', $item->book) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium hover:underline" wire:navigate>
                                                {{ $item->book->title }}
                                            </a>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $item->borrow_count }} {{ __('borrows') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{ __('Active members (last 30 days)') }}
                        </h3>
                    </div>
                    <div class="p-6">
                        @if ($activeMembers->isEmpty())
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('No data yet.') }}</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($activeMembers as $index => $member)
                                    <div class="py-3 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-900/50 rounded-lg px-2 -mx-2 transition">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                            </div>
                                            <span class="text-gray-900 dark:text-white font-medium">{{ $member->name }}</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $member->borrows_count }} {{ __('borrows') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
