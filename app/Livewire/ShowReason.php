<?php

namespace App\Livewire;

use App\Models\Reason;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class ShowReason extends Component
{
    public ?Reason $reason;

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
        $this->reason = Reason::all()->random(1)->first() ?? [];

        return view('livewire.show-reason');
    }
}
