<?php

namespace App\Livewire;

use App\Models\Reason;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class ShowReason extends Component
{
    public ?Reason $reason = null;

    public string $default = '';

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

    public function refresh(): void
    {
        usleep(500000);

        $nextReason = Reason::approved()
            ->when($this->reason, function ($query) {
                return $query->where('id', '!=', $this->reason->id);
            })
            ->inRandomOrder()
            ->first();

        if (!$nextReason) {
            $nextReason = Reason::approved()->inRandomOrder()->first();
        }

        if ($nextReason) {
            $this->reason = $nextReason;
        } else {
            $this->reason = null;
            $this->default = 'No one has added a reason yet, be the first!';
        }
    }

    public function render(): View
    {
        $randomReason = Reason::approved()->inRandomOrder()->first();
        if ($randomReason) {
            $this->reason = $randomReason;
        } else {
            $this->default = 'No one has added a reason yet, be the first!';
        }

        return view('livewire.show-reason');
    }
}
