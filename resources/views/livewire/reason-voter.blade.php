<div class="flex items-center gap-2 pointer-events-auto">
    <button
        wire:click.stop="vote('up')"
        class="flex items-center gap-1 rounded-lg px-3 py-1.5 transition-colors
        {{ $this->voteStatus === 'up' ? 'bg-green-100 ring-1 ring-green-500' : 'bg-gray-50 hover:bg-green-50' }} group/up"
    >
        <svg class="h-5 w-5 {{ $this->voteStatus === 'up' ? 'text-green-600' : 'text-gray-400 group-hover/up:text-green-500' }}" fill="currentColor" viewBox="0 0 20 20">
            <path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/>
        </svg>
        <span class="text-sm font-bold {{ $this->voteStatus === 'up' ? 'text-green-700' : 'text-gray-600 group-hover/up:text-green-600' }}">
            {{ $reason->upvotes ?? 0 }}
        </span>
    </button>

    <button
        wire:click.stop="vote('down')"
        class="flex items-center gap-1 rounded-lg px-3 py-1.5 transition-colors
        {{ $this->voteStatus === 'down' ? 'bg-red-100 ring-1 ring-red-500' : 'bg-gray-50 hover:bg-red-50' }} group/down"
    >
        <svg class="h-5 w-5 {{ $this->voteStatus === 'down' ? 'text-red-600' : 'text-gray-400 group-hover/down:text-red-500' }}" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
        </svg>
        <span class="text-sm font-bold {{ $this->voteStatus === 'down' ? 'text-red-700' : 'text-gray-600 group-hover/down:text-red-600' }}">
            {{ $reason->downvotes ?? 0 }}
        </span>
    </button>

    <div class="flex items-center gap-2 pointer-events-auto">
        @if (session()->has('vote_error'))
            <span class="text-[10px] absolute -bottom-6 right-0 uppercase tracking-wider text-red-500 font-bold whitespace-nowrap">
            {{ session('vote_error') }}
        </span>
        @endif
    </div>
</div>
