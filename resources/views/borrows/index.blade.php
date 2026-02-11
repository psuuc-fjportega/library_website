<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ auth()->user()->role === 'member' ? __('My Borrows') : __('Borrow Requests') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ auth()->user()->role === 'member' ? __('Track your borrowed books') : __('Manage borrow requests') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('status') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ $errors->first() }}</p>
                </div>
            @endif

            @if (in_array(auth()->user()->role, ['admin', 'librarian'], true))
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <form action="{{ route('borrows.index') }}" method="GET" class="flex gap-4 items-end">
                            <div class="flex-1">
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="pending" @selected(request('status') === 'pending')>{{ __('Pending') }}</option>
                                    <option value="approved" @selected(request('status') === 'approved')>{{ __('Approved') }}</option>
                                    <option value="rejected" @selected(request('status') === 'rejected')>{{ __('Rejected') }}</option>
                                    <option value="returned" @selected(request('status') === 'returned')>{{ __('Returned') }}</option>
                                </select>
                            </div>
                            <x-primary-button type="submit" class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                {{ __('Filter') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            @endif

            @if ($borrows->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('No borrow records') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ auth()->user()->role === 'member' ? __('You haven\'t borrowed any books yet.') : __('No borrow requests found.') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($borrows as $borrow)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <a href="{{ route('books.show', $borrow->book) }}" class="group">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                                        {{ $borrow->book->title }}
                                                    </h3>
                                                </a>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $borrow->book->author }}</p>
                                                @if (auth()->user()->role !== 'member')
                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                        <span class="font-medium">{{ __('Requested by') }}:</span> {{ $borrow->user->name }}
                                                    </p>
                                                @endif
                                                <div class="mt-3 flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ __('Requested') }}: {{ $borrow->requested_at->format('M j, Y') }}
                                                    </span>
                                                    @if ($borrow->approved_at)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {{ __('Processed') }}: {{ $borrow->approved_at->format('M j, Y') }}
                                                        </span>
                                                    @endif
                                                    @if ($borrow->due_date)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {{ __('Due') }}: {{ $borrow->due_date->format('M j, Y') }}
                                                        </span>
                                                    @endif
                                                    @if ($borrow->returned_at)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            {{ __('Returned') }}: {{ $borrow->returned_at->format('M j, Y') }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full
                                            @if ($borrow->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200
                                            @elseif ($borrow->status === 'approved') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200
                                            @elseif ($borrow->status === 'rejected') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-200
                                            @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                                            {{ ucfirst($borrow->status) }}
                                        </span>
                                        @can('manage', $borrow)
                                            @if ($borrow->isPending())
                                                <div class="flex gap-2">
                                                    <form action="{{ route('borrows.approve', $borrow) }}" method="POST" class="inline">
                                                        @csrf
                                                        <x-primary-button type="submit" class="flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            {{ __('Approve') }}
                                                        </x-primary-button>
                                                    </form>
                                                    <form action="{{ route('borrows.reject', $borrow) }}" method="POST" class="inline">
                                                        @csrf
                                                        <x-danger-button type="submit" class="flex items-center gap-2">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            {{ __('Reject') }}
                                                        </x-danger-button>
                                                    </form>
                                                </div>
                                            @elseif ($borrow->isApproved())
                                                <form action="{{ route('borrows.return', $borrow) }}" method="POST" class="inline">
                                                    @csrf
                                                    <x-primary-button type="submit" class="flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        {{ __('Mark returned') }}
                                                    </x-primary-button>
                                                </form>
                                            @endif
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $borrows->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
