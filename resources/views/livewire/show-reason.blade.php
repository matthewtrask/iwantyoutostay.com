<div class="relative h-screen w-full overflow-hidden border-t-4 sm:border-t-8 border-b-4 sm:border-b-8 border-yellow-500 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 flex flex-col">

    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

<div class="relative flex flex-grow items-center justify-center p-4 sm:p-6 md:p-8">

    <div class="group relative w-full max-w-2xl rounded-xl sm:rounded-2xl bg-white shadow-xl ring-2 sm:ring-4 ring-yellow-500 ring-offset-2 sm:ring-offset-4 ring-offset-blue-700 transition-shadow duration-300">
        <div
            wire:click="refresh"
            class="absolute inset-0 z-10 cursor-pointer rounded-xl sm:rounded-2xl"
        ></div>

        <div class="relative z-20 p-6 sm:p-8 md:p-10 pointer-events-none">

            <div class="mb-3 sm:mb-4 flex items-center justify-between gap-2">
                <div class="inline-block rounded-full bg-yellow-500 px-3 sm:px-4 py-1">
                    <span class="text-xs sm:text-sm font-semibold text-white">We 💙 Music City</span>
                </div>

                @if($reason)
                    @livewire('reason-voter', ['reason' => $reason], key('voter-'.$reason->id))
                @endif
            </div>

            <h1 class="mb-4 sm:mb-6 text-2xl sm:text-3xl md:text-4xl font-bold leading-tight text-gray-900">
                I want you to stay in Nashville...
            </h1>

            <div class="relative h-[160px] sm:h-[200px] w-full grid place-items-center overflow-hidden">
                <div
                    wire:key="reason-{{ $reason?->id ?? 'default' }}"
                    wire:replace
                    class="w-full text-center col-start-1 row-start-1"
                >
                    @if(! is_null($reason))
                        <p class="text-lg sm:text-xl md:text-2xl leading-relaxed text-gray-700 font-medium italic text-pretty">
                            "{{ trim($reason->reason) }}"
                        </p>
                    @else
                        <p class="text-lg sm:text-xl md:text-2xl leading-relaxed text-gray-700 font-medium italic">
                            "{{ $default }}"
                        </p>
                    @endif
                </div>
            </div>

            <div class="mt-4 sm:mt-6 flex items-center justify-between">
                <div class="h-1 w-16 sm:w-20 rounded-full bg-gradient-to-r from-yellow-500 to-yellow-600"></div>
                <div class="h-5 flex items-center">
                    <div wire:loading wire:target="refresh" class="text-yellow-600 animate-pulse text-xs font-bold uppercase">
                        Finding another...
                    </div>
                </div>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <p class="text-xs sm:text-sm text-gray-400 italic">
                    Tap the card to see another reason
                </p>

                <!-- Social Share Buttons - Right aligned -->
                <div class="flex items-center gap-1 pointer-events-auto">

                    <button
                        onclick="shareToBluesky('{{ addslashes($reason->reason ?? $default) }}')"
                        class="p-1.5 sm:p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors"
                        title="Share on Bluesky"
                        aria-label="Share on Bluesky"
                    >
                        <svg class="w-4 h-4 text-gray-700" fill="currentColor" viewBox="0 0 600 530">
                            <path d="m135.72 44.03c66.496 49.921 138.02 151.14 164.28 205.46 26.262-54.316 97.782-155.54 164.28-205.46 47.98-36.021 125.72-63.892 125.72 24.795 0 17.712-10.155 148.79-16.111 170.07-20.703 73.984-96.144 92.854-163.25 81.433 117.3 19.964 147.14 86.092 82.697 152.22-122.39 125.59-175.91-31.511-189.63-71.766-2.514-7.3797-3.6904-10.832-3.7077-7.8964-0.0174-2.9357-1.1937 0.51669-3.7077 7.8964-13.714 40.255-67.233 197.36-189.63 71.766-64.444-66.128-34.605-132.26 82.697-152.22-67.108 11.421-142.55-7.4491-163.25-81.433-5.9562-21.282-16.111-152.36-16.111-170.07 0-88.687 77.742-60.816 125.72-24.795z"/>
                        </svg>
                    </button>

                    <button
                        onclick="shareToFacebook()"
                        class="p-1.5 sm:p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors"
                        title="Share on Facebook"
                        aria-label="Share on Facebook"
                    >
                        <svg class="w-4 h-4 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>

                    <button
                        onclick="copyLink()"
                        class="p-1.5 sm:p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors"
                        title="Copy link"
                        aria-label="Copy link"
                    >
                        <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
    </div>
</div>

<div class="fixed bottom-4 sm:bottom-8 right-4 sm:right-8 z-50">
    @if(!$showForm)
        <div class="flex flex-col items-stretch gap-2 w-full sm:w-auto sm:min-w-[200px]">
            <div class="rounded-full bg-white border-2 border-yellow-500 px-3 sm:px-4 py-1 shadow-lg animate-pulse-slow">
                <span class="text-xs sm:text-sm font-semibold text-gray-900 whitespace-nowrap">
                    <span class="text-yellow-600">{{ $reasonCount }}</span> reasons and counting!
                </span>
            </div>
            <button wire:click.stop="toggleForm" class="group flex items-center justify-center gap-2 rounded-full bg-yellow-500 px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base font-semibold text-white shadow-lg transition-all duration-300 hover:bg-yellow-600 hover:shadow-xl">
                <span class="hidden sm:inline">Add Your Reason</span>
                <span class="sm:hidden">Add Reason</span>
                <svg class="h-4 w-4 sm:h-5 sm:w-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </button>
        </div>
    @else
        <div
            x-data
            wire:click.stop
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            class="fixed inset-x-4 bottom-4 sm:inset-x-auto sm:bottom-8 sm:right-8 sm:w-96 rounded-2xl bg-white p-5 sm:p-6 shadow-2xl ring-2 sm:ring-4 ring-yellow-500 max-h-[90vh] overflow-y-auto"
        >
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Add Your Reason</h3>
                <button wire:click.stop="toggleForm" class="text-gray-400 transition-colors hover:text-gray-600 p-1">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            @if($submitted)
                <div
                    x-data
                    x-init="setTimeout(() => $wire.toggleForm(), 3000)"
                    class="rounded-lg bg-green-50 p-4 text-green-800 border border-green-200"
                >
                    <p class="font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Thanks for sharing!
                    </p>
                    <p class="text-sm">Your reason has been submitted and is pending review.</p>
                </div>
            @else
                <form wire:submit.prevent="submitReason">
                    <div class="mb-4">
                        <label for="newReason" class="mb-2 block text-sm font-medium text-gray-700">Why should we stay?</label>
                        <textarea wire:model="newReason" id="newReason" rows="4" class="w-full rounded-lg border border-gray-300 p-3 text-base focus:border-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="e.g. The hot chicken and the community spirit..."></textarea>
                        @error('newReason') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" wire:loading.attr="disabled" class="w-full rounded-lg bg-yellow-500 px-4 py-3 text-base font-semibold text-white transition-all hover:bg-yellow-600 active:bg-yellow-700 disabled:opacity-50">
                        <span wire:loading.remove wire:target="submitReason">Submit Reason</span>
                        <span wire:loading wire:target="submitReason">Submitting...</span>
                    </button>
                </form>
            @endif
        </div>
    @endif
</div>

<script>
    function shareToBluesky(reason) {
        const text = `I want you to stay in Nashville "${reason}"\n\nhttps://iwantyoutostay.com\n\n#nashville`;
        const url = `https://bsky.app/intent/compose?text=${encodeURIComponent(text)}`;
        window.open(url, '_blank', 'width=550,height=600');
    }

    function shareToFacebook() {
        const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent('https://iwantyoutostay.com')}`;
        window.open(url, '_blank', 'width=550,height=420');
    }

    function copyLink() {
        navigator.clipboard.writeText('https://iwantyoutostay.com').then(() => {
            alert('Link copied to clipboard!');
        }).catch(() => {
            const textarea = document.createElement('textarea');
            textarea.value = 'https://iwantyoutostay.com';
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Link copied to clipboard!');
        });
    }
</script>
</div>
