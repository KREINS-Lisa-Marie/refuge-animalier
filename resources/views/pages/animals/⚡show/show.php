<?php

use App\Models\Animal;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component

{
    public int $animal_id;

    public function mount(Animal $animal): void
    {
        $this->animal_id = $animal->id;
    }

    public function destroy()
    {
        $animal = Animal::findOrFail($this->animal_id);
        $animal->delete();
        return redirect(route('pages::animals.index', ['locale' => app()->getLocale()]));
    }
};
