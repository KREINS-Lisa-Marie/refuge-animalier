<?php

use App\Models\Animal;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    public Animal $animal;

    public function mount(Animal $animal): void
    {
        $this->animal = $animal;
    }
};
