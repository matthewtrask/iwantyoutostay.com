<?php

namespace App\Livewire;

use App\Models\Reason;
use App\Models\Vote;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReasonVoter extends Component
{
    public Reason $reason;

    public function vote(string $type): void
    {
        $existingVote = Vote::where('reason_id', $this->reason->id)
            ->where('ip_address', request()->ip())
            ->first();

        DB::transaction(function () use ($type, $existingVote) {
            if ($existingVote) {
                if ($existingVote->type === $type) {
                    $this->reason->decrement($type === 'up' ? 'upvotes' : 'downvotes');
                    $existingVote->delete();
                }
                else {
                    $this->reason->decrement($existingVote->type === 'up' ? 'upvotes' : 'downvotes');
                    $this->reason->increment($type === 'up' ? 'upvotes' : 'downvotes');
                    $existingVote->update(['type' => $type]);
                }
            } else {
                Vote::create([
                    'reason_id' => $this->reason->id,
                    'ip_address' => request()->ip(),
                    'type' => $type,
                ]);
                $this->reason->increment($type === 'up' ? 'upvotes' : 'downvotes');
            }
        });

        $this->reason->refresh();
    }

    public function render()
    {
        return view('livewire.reason-voter');
    }

    public function getVoteStatusProperty()
    {
        return Vote::where('reason_id', $this->reason->id)
            ->where('ip_address', request()->ip())
            ->value('type'); // returns 'up', 'down', or null
    }
}
