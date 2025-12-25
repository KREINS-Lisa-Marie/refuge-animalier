<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new  #[Layout('layouts.dashboard')] class extends Component
{
    public $volunteers;

    public function mount(): void
    {
        $this->volunteers = User::get();
    }
};
