<?php

use App\Models\Animal;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component

{
    public Animal $animal;

    public function mount(Animal $animal): void
    {
        $this->authorize('view', $animal);
        $this->animal = $animal;
    }

    public function destroy()
    {
        $animal = Animal::findOrFail($this->animal->id);
        $this->authorize('delete', $animal);
        $this->animal->delete();
        return redirect(route('pages::animals.index', ['locale' => app()->getLocale()]));
    }

    public function render()
    {
        $birthday = $this->animal->age;
        $today = now();

        $age = $today->diff($birthday);
        $age = $age->y;


        return view('pages.animals.⚡show.show', ['animal'=> $this->animal, 'age'=>$age])->title(__('general.animals_show'));

    }
};
