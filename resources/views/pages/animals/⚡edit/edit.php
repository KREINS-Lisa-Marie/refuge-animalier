<?php

use App\Models\Animal;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{

    public Animal $animal;
    public string $animal_name = '';
    public string $species;
    public string $race = '';
    public string $sex = '';
    public string $fur = '';
    public string $age = '';
    public string $vaccinations = '';
    public string $character = '';
    public string $state = '';
    public string $description = '';
    //public string $show_image = '/assets/img/border-collie.jpg';
    //public string $gallery_images = '';

    public function mount(Animal $animal): void
    {
        $this->animal = $animal;
        $this->animal_name = $animal->animal_name;
        $this->species = $animal->species;
        $this->race = $animal->race ?? '';
        $this->sex = $animal->sex;
        $this->fur = $animal->fur ?? '';
        $this->age = $animal->age;
        $this->vaccinations = $animal->vaccinations;
        $this->character = $animal->character ?? '';
        $this->state = $animal->state;
        $this->description = $animal->description ?? '';
        //$this->show_image = $animal->show_image ?? '/assets/img/border-collie.jpg';
       // $this->gallery_images = $animal->gallery_images ?? '';
    }


    public function save(): void
    {
        $validated_data = $this->validate(
            [
            'animal_name'=>'required|string|max:255',
            'species'=>'required|string',
            'race'=>'string|nullable',
            'sex'=>'required|string',
            'fur'=>'string|nullable',
            'age'=>'required|integer',
            'vaccinations'=>'string|nullable',
            'character'=>'string|nullable',
            'state'=>'required|string',
            'description'=>'string|nullable',
            //'show_image'=>'nullable|image',
            //'gallery_images'=>'nullable|image',
        ]
        );

        $this->animal->update($validated_data);

        $this->redirect(route('pages::animals.show', ['locale' => app()->getLocale(), 'animal' => $this->animal])
    );
    }
};
