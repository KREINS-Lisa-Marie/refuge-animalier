<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new  #[Layout('layouts.app')] class extends Component
{
    use \Livewire\WithPagination;

    public $volunteers;
    public string $term = '';




    //tri
    public $sortField = 'last_name';
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
        $this->authorize('viewAny', User::class);        //sinon ça doit à chaque sort vérifier authorization        //tous les users peuvent voir tous les users
    }





    #[Computed]
    public function searchedUsers()
    {
        return
            User::query()
                ->where('first_name', 'like', '%' . $this->term . '%')
                ->orWhere('last_name', 'like', '%' . $this->term . '%')
                ->orWhere('phone', 'like', '%' . $this->term . '%')
                ->orWhere('is_admin', 'like', '%' . $this->term . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
    }

    public function render()
    {
        return view('pages.volunteers.⚡index.index')->title(__('general.volunteers'));
    }


};
