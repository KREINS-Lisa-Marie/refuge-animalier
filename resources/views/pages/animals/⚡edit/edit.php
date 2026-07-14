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
    public $age = '';
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
        $this->age = $animal->age ?? '';
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
            'age'=>'required|date',
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

    public function render()
    {
        $animal_state_options =[
            [
                'name' => __('admin/animals.adopted'),
                'value' =>'adopted',
            ],
            [
                'name' => __('admin/animals.processing_adoption'),
                'value' =>'processing_adoption',
            ],
            [
                'name' => __('admin/animals.in_treatment'),
                'value' =>'in_treatment',
            ],
            [
                'name' => __('admin/animals.adoptable'),
                'value' =>'adoptable',
            ],
        ];
        $gender = [
            [
                'name' => __('admin/animals.male'),
                'value' =>'male',
            ],
            [
                'name' => __('admin/animals.female'),
                'value' =>'female',
            ],
        ];

        $species_options = [
            [
                'name' => __('admin/animals.dog'),
                'value' =>'dog',
            ],
            [
                'name' => __('admin/animals.cat'),
                'value' =>'cat',
            ],
            [
                'name' => __('admin/animals.hamster'),
                'value' =>'hamster',
            ],
            [
                'name' => __('admin/animals.bunny'),
                'value' =>'bunny',
            ],
        ];

        return view('pages.animals.⚡edit.edit', compact('animal_state_options', 'gender', 'species_options'))
            ->title(__('general.animals_edit'));
    }
};
