<div class="relative min-h-screen w-full overflow-hidden border-t-4 sm:border-t-8 border-b-4 sm:border-b-8 border-yellow-500 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800">
    <!-- Optional: subtle pattern overlay -->
    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="relative flex min-h-screen items-center justify-center p-4 sm:p-6 md:p-8">
        <div wire:click="refresh" class="group w-full max-w-2xl transform cursor-pointer rounded-xl sm:rounded-2xl bg-white p-6 sm:p-8 md:p-10 shadow-xl ring-2 sm:ring-4 ring-yellow-500 ring-offset-2 sm:ring-offset-4 ring-offset-blue-700 transition-transform duration-300 hover:scale-105 active:scale-95">
            <!-- Optional: small decorative element -->
            <div class="mb-3 sm:mb-4 inline-block rounded-full bg-yellow-500 px-3 sm:px-4 py-1">
                <span class="text-xs sm:text-sm font-semibold text-white">We 💛 Music City</span>
            </div>

            <h1 class="mb-4 sm:mb-6 text-2xl sm:text-3xl md:text-4xl font-bold leading-tight text-gray-900">
                I want you to stay in Nashville...
            </h1>

            <p class="text-lg sm:text-xl md:text-2xl leading-relaxed text-gray-700">
                {{ $reason->reason }}
            </p>

            <!-- Optional: subtle bottom accent -->
            <div class="mt-4 sm:mt-6 h-1 w-16 sm:w-20 rounded-full bg-gradient-to-r from-yellow-500 to-yellow-600"></div>

            <!-- Tap to refresh hint on mobile -->
            <p class="mt-4 text-xs sm:text-sm text-gray-400 italic">Tap to refresh</p>
        </div>
    </div>

    <!-- Floating button and form -->
    <div class="fixed bottom-4 sm:bottom-8 right-4 sm:right-8 z-50">
        @if(!$showForm)
            <button
                wire:click="toggleForm"
                class="group flex items-center gap-2 rounded-full bg-yellow-500 px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:bg-yellow-600 hover:shadow-xl active:scale-95"
            >
                <span class="hidden sm:inline">Add Your Reason</span>
                <span class="sm:hidden">Add Reason</span>
                <svg class="h-4 w-4 sm:h-5 sm:w-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </button>
        @else
            <div class="fixed inset-x-4 bottom-4 sm:inset-x-auto sm:bottom-8 sm:right-8 sm:w-96 rounded-2xl bg-white p-5 sm:p-6 shadow-2xl ring-2 sm:ring-4 ring-yellow-500 max-h-[90vh] overflow-y-auto">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900">Add Your Reason</h3>
                    <button
                        wire:click="toggleForm"
                        class="text-gray-400 transition-colors hover:text-gray-600 p-1"
                    >
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                @if($submitted)
                    <div class="rounded-lg bg-yellow-50 p-4 text-yellow-800">
                        <p class="font-semibold">Thanks for sharing!</p>
                        <p class="text-sm">Your reason has been submitted.</p>
                    </div>
                @else
                    <form wire:submit.prevent="submitReason">
                        <div class="mb-4">
                            <label for="newReason" class="mb-2 block text-sm font-medium text-gray-700">
                                Why should we stay?
                            </label>
                            <textarea
                                wire:model="newReason"
                                id="newReason"
                                rows="4"
                                class="w-full rounded-lg border border-gray-300 p-3 text-base focus:border-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                placeholder="and..."
                            ></textarea>
                            @error('newReason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="w-full rounded-lg bg-yellow-500 px-4 py-3 text-base font-semibold text-white transition-colors hover:bg-yellow-600 active:bg-yellow-700"
                        >
                            Submit Reason
                        </button>
                    </form>
                @endif
            </div>
        @endif
    </div>
</div>
