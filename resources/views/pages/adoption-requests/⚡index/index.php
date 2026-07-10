<?php

use App\Models\Animal;
use \App\Models\Request;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    use \Livewire\WithPagination;

    public $requests;
    public bool $showModal = false;
    public $openRequest = null;

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

    public function requestAccept():void
    {
        if ( $this->openRequest ){

            $this->openRequest->update([
                'state'=>'adopted'
            ]);
            $this->closeModal();
        }
    }

    public function requestDeny():void
    {
        if ( $this->openRequest ){

            $this->openRequest->update([
                'state'=>'refused'
            ]);
            $this->closeModal();
        }
    }


    public function openModal( int $request_id):void
    {
        $this->openRequest = Request::findOrFail($request_id );
        $this->showModal = true;
    }

    //fermer modale
    public function closeModal():void
    {
        $this->showModal = false;
        $this->openRequest = null;
    }


    #[Computed]
    public function searchedRequests()
    {
        return
             Request::query()
                 ->join('animals','requests.animal_id', '=', 'animals.id' )
                 ->select('requests.*', 'animals.animal_name')
                ->where('requests.first_name', 'like', '%' . $this->term . '%')
                ->orWhere('requests.last_name', 'like', '%' . $this->term . '%')
                ->orWhere('animals.animal_name', 'like', '%' . $this->term . '%')
                ->orWhere('requests.state', 'like', '%' . $this->term . '%')
                 ->orderBy($this->sortField, $this->sortDirection)
                 ->paginate(10);
    }

    public function render()
    {
        return view('pages.adoption-requests.⚡index.index')->title(__('general.adoption-requests'));
    }
};
