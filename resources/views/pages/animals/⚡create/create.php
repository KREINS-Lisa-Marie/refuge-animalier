<?php

use App\Http\Requests\StoreAnimalRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{

    public string $animal_name;
    public string $species;
    public string $race = '';
    public string $sex;
    public string $fur = '';
    public string $age;
    public string $vaccinations = '';
    public string $character = '';
    public string $state;
    public string $description = '';
    public string $show_image = '';
    public string $gallery_images = '';


    public function render()        //à chaque fois que qqch sur la page change
    {
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
        $user = auth()->user();
        return view('pages.animals.⚡create.create',['gender' => $gender, 'user' => $user] )->title(__('general.animals_create'));
    }


    public function store(): void
    {
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

        $this->validate([
            'animal_name'=>'required|string|max:255',
            'species'=>'string|required',
            'race'=>'string|nullable',
            'sex'=>'string|required',
            'fur'=>'string|nullable',
            'age'=>'string|required',
            'vaccinations'=>'string|nullable',
            'character'=>'string|nullable',
            'state'=>'string|required',
            'description'=>'string|nullable',
            'show_image'=>'nullable|image',
            'gallery_images'=>'nullable|image',
        ]);

        \App\Models\Animal::create([
            'animal_name' => $this->animal_name,
            'species' => $this->species,
            'race' => $this->race,
            'sex' => $this->sex,
            'fur' => $this->fur,
            'age' => $this->age,
            'vaccinations' => $this->vaccinations,
            'character' => $this->character,
            'state' => $this->state,
            'description' => $this->description,
            'show_image' => $this->show_image,
            'gallery_images' => $this->gallery_images,
        ]);

        $this->redirect(route('pages::animals.index', ['locale' => __('general.currentLocale'), 'gender' => $gender]));
    }
};
