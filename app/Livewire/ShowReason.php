<?php

namespace App\Livewire;

use App\Models\Reason;
use Illuminate\View\View;
use Livewire\Component;

class ShowReason extends Component
{
    public ?Reason $reason = null;
    public int $reasonCount = 0;

    public string $default = '';
    public bool $showForm = false;
    public string $newReason = '';
    public bool $submitted = false;

    // This runs ONCE when the page first loads
    public function mount(): void
    {
        $this->loadInitialReason();
    }

    public function loadInitialReason(): void
    {
        $this->reason = Reason::approved()->inRandomOrder()->first();
        $this->reasonCount = Reason::approved()->count() ?? 0;
        if (!$this->reason) {
            $this->default = 'No one has added a reason yet, be the first!';
        }
    }

    public function refresh(): void
    {
        // Add a tiny delay for the "Finding another..." pulse effect
        usleep(300000);

        $nextReason = Reason::approved()
            ->where('id', '!=', $this->reason?->id)
            ->inRandomOrder()
            ->first();

        if ($nextReason) {
            $this->reason = $nextReason;
        }
    }

    public function render(): View
    {
        // KEEP THIS CLEAN. Don't fetch new random data here.
        return view('livewire.show-reason');
    }

    public function toggleForm(): void
    {
        $this->showForm = !$this->showForm;
        $this->reset('newReason', 'submitted');
    }

    public function submitReason(): void
    {
        $this->validate([
            'newReason' => 'required|min:3|max:500',
        ]);

        Reason::create([
            'reason' => $this->newReason,
        ]);

        $this->submitted = true;
        $this->reset('newReason');
    }
}
