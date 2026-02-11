<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl md:text-3xl text-gray-900 dark:text-gray-100 leading-tight tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-1.5 text-base text-gray-600 dark:text-gray-400">
                    {{ __('Welcome back, :name!', ['name' => auth()->user()->name]) }}
                </p>
            </div>

            <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full shadow-sm
                @if($role === 'admin')    bg-gradient-to-r from-red-500/10 to-red-600/10 text-red-700 dark:from-red-600/20 dark:to-red-700/20 dark:text-red-300 border border-red-200/60 dark:border-red-700/40
                @elseif($role === 'librarian') bg-gradient-to-r from-blue-500/10 to-blue-600/10 text-blue-700 dark:from-blue-600/20 dark:to-blue-700/20 dark:text-blue-300 border border-blue-200/60 dark:border-blue-700/40
                @else                      bg-gradient-to-r from-green-500/10 to-green-600/10 text-green-700 dark:from-green-600/20 dark:to-green-700/20 dark:text-green-300 border border-green-200/60 dark:border-green-700/40 @endif">
                <div class="h-2.5 w-2.5 rounded-full
                    @if($role === 'admin') bg-red-500
                    @elseif($role === 'librarian') bg-blue-500
                    @else bg-green-500 @endif"></div>
                <span class="font-medium">{{ ucfirst($role) }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if ($role === 'admin')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">

                    <x-dashboard.stat-card
                        title="{{ __('Categories') }}"
                        value="{{ $categoriesCount ?? 0 }}"
                        description="{{ __('Total categories') }}"
                        icon="tag"
                        color="indigo"
                        href="{{ route('categories.index') }}"
                    />

                    <x-dashboard.stat-card
                        title="{{ __('Books') }}"
                        value="{{ $booksCount ?? 0 }}"
                        description="{{ __('In catalog') }}"
                        icon="book"
                        color="blue"
                        href="{{ route('books.index') }}"
                    />

                    <x-dashboard.stat-card
                        title="{{ __('Pending Requests') }}"
                        value="{{ $pendingBorrowsCount ?? 0 }}"
                        description="{{ __('Awaiting approval') }}"
                        icon="clock"
                        color="amber"
                        href="{{ route('borrows.index') }}"
                    />

                    <x-dashboard.stat-card
                        title="{{ __('Users') }}"
                        value="{{ ($membersCount ?? 0) + ($librariansCount ?? 0) }}"
                        description="{{ __(':m members • :l librarians', ['m' => $membersCount ?? 0, 'l' => $librariansCount ?? 0]) }}"
                        icon="users"
                        color="purple"
                    />

                </div>

            @elseif ($role === 'librarian')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <x-dashboard.stat-card
                        title="{{ __('Pending Borrows') }}"
                        value="{{ $pendingBorrowsCount ?? 0 }}"
                        description="{{ __('Requests to review') }}"
                        icon="clock"
                        color="amber"
                        large
                        href="{{ route('borrows.index') }}"
                    />

                    <x-dashboard.stat-card
                        title="{{ __('Books') }}"
                        value="{{ $booksCount ?? 0 }}"
                        description="{{ __('In the system') }}"
                        icon="book"
                        color="blue"
                        large
                        href="{{ route('books.index') }}"
                    />

                </div>

            @else   <!-- Member -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <a href="{{ route('books.index') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-500/90 to-indigo-700 p-7 md:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
                        <div class="relative z-10">
                            <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white">{{ __('Browse Books') }}</h3>
                            <p class="mt-2 text-white/90">{{ __('Discover new titles and request to borrow') }}</p>
                        </div>
                    </a>

                    <a href="{{ route('borrows.index') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500/90 to-emerald-700 p-7 md:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
                        <div class="relative z-10">
                            <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white">{{ __('My Borrows') }}</h3>
                            <p class="mt-1 text-3xl font-bold text-white">{{ $myBorrowsCount ?? 0 }}</p>
                            @if (isset($myPendingCount) && $myPendingCount > 0)
                                <p class="mt-1 text-sm text-white/90">{{ __(':count pending', ['count' => $myPendingCount]) }}</p>
                            @endif
                        </div>
                    </a>

                </div>
            @endif

            @if (isset($recentBorrows) && $recentBorrows->isNotEmpty())
                <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/70 dark:border-gray-700/60 shadow-xl rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50/80 to-white/50 dark:from-gray-900/50 dark:to-gray-800/50">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2.5">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            {{ $role === 'member' || $role === '' ? __('Your Recent Activity') : __('Recent Borrow Requests') }}
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($recentBorrows->take(6) as $borrow)
                            <div class="px-6 py-4 hover:bg-gray-50/70 dark:hover:bg-gray-800/50 transition-colors">
                                <div class="flex items-center justify-between gap-4 flex-wrap sm:flex-nowrap">
                                    <a href="{{ route('books.show', $borrow->book) }}" class="flex items-center gap-4 flex-1 min-w-0 group" wire:navigate>
                                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center group-hover:bg-indigo-200 dark:group-hover:bg-indigo-900/50 transition">
                                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-gray-900 dark:text-white truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                                {{ $borrow->book->title }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                {{ $role === 'member' ? $borrow->book->author : $borrow->user->name }}
                                            </p>
                                        </div>
                                    </a>

                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full whitespace-nowrap
                                        @if ($borrow->status === 'pending') bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-200
                                        @elseif ($borrow->status === 'approved') bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200
                                        @elseif ($borrow->status === 'rejected') bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200
                                        @else bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 @endif">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/30 text-center sm:text-right">
                        <a href="{{ route('borrows.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors" wire:navigate>
                            {{ __('View all borrow records') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>