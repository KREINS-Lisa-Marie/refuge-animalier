<?php

use App\Models\Animal;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    public $animals;

    public function mount(): void
    {
        $this->animals = Animal::get();
    }
};
