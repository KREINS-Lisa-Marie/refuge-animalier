<?php

use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    use \Livewire\WithPagination;

    public $animals;
    public string $term = '';


    //tri
    public $sortField = 'animal_name';
    public $sortDirection = 'asc';
    protected $queryString =['sortField', 'sortDirection'];


    public function sortBy($field)
    {
        if ($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updateState( $animal, $state)
    {
        $this->authorize('update', $animal);
        Animal::findOrFail($animal)->update([
            'state'=>$state,
        ]);
    }

    public function mount(): void
    {
        $this->authorize('viewAny', Animal::class);        //sinon ça doit à chaque sort vérifier authorization        //tous les users peuvent voir tous les animaux
    }


    #[Computed]
    public function searchedAnimals()
    {
        return
            Animal::query()
                ->where('animal_name', 'like', '%' . $this->term . '%')
                ->orWhere('species', 'like', '%' . $this->term . '%')
                ->orWhere('state', 'like', '%' . $this->term . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
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

        return view('pages.animals.⚡index.index', ['gender' => $gender, 'animal_state_options'=>$animal_state_options, 'species_options'=>$species_options] )->title(__('general.animals'));
    }

};
