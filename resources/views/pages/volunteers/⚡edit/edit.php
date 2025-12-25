<?php

use App\Models\Availability;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{

    public User $volunteer;
    public Availability $availabilities;

    public function mount(User $volunteer): void
    {
        $this->volunteer = $volunteer;
        $this->availabilities = Availability::where('user_id', $volunteer->id)->first();
    }
};
