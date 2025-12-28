<?php

use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public $animals;
    public string $term = '';


    public function mount(): void
    {
        $this->animals = Animal::get();
    }


    #[Computed]
    public function searchedAnimals()
    {
        return
            Animal::query()
                ->where('animal_name', 'like', '%' . $this->term . '%')
                ->orWhere('species', 'like', '%' . $this->term . '%')
                ->orWhere('state', 'like', '%' . $this->term . '%')
                ->orderBy('created_at', 'asc')
                ->get();
    }


};
