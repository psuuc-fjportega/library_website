<div @class([
    'group relative overflow-hidden rounded-2xl shadow-xl transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:scale-[1.02]',
    'bg-gradient-to-br' => true,
    "from-{$color}-500/95 to-{$color}-700" => true,
])>
    <a href="{{ $href ?? '#' }}" class="block p-6 md:p-8 h-full" wire:navigate>
        <div class="relative z-10 flex flex-col h-full">
            <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                <!-- You can replace with x-heroicon or any icon library -->
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    @if ($icon === 'tag')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    @elseif ($icon === 'book')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    @elseif ($icon === 'clock')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    @elseif ($icon === 'users')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    @else
                        <circle cx="12" cy="12" r="10" />
                    @endif
                </svg>
            </div>

            <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>

            <div class="mt-auto">
                <p class="text-4xl md:text-5xl font-bold text-white mt-3">{{ $value }}</p>
                <p class="mt-1.5 text-sm text-white/80">{{ $description }}</p>
            </div>
        </div>
    </a>
</div>