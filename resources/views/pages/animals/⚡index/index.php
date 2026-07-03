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
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
    }


};
