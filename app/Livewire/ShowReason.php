<?php

namespace App\Livewire;

use App\Models\Reason;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class ShowReason extends Component
{
    public Reason $reason;

    public bool $showForm = false;
    public string $newReason = '';
    public bool $submitted = false;

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

    public function refresh()
    {
        $this->reason = Reason::where('id', '!=', $this->reason->id)
            ->inRandomOrder()
            ->first();
    }

    public function render(): View
    {
        // Try to get one random reason from the database
        $randomReason = Reason::inRandomOrder()->first();

        // If one exists, assign it. If not, create a "dummy" model
        // or handle the empty state so the property isn't uninitialized.
        if ($randomReason) {
            $this->reason = $randomReason;
        } else {
            // Option A: Create a blank model so the UI doesn't crash
            $this->reason = new Reason(['reason' => 'No reasons found yet. Add one below!']);
        }

        return view('livewire.show-reason');
    }
}
