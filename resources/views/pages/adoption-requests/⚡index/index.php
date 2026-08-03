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


    public function mount(): void
    {
        $this->authorize('viewAny', Request::class);        //sinon ça doit à chaque sort vérifier authorization        //tous les users peuvent voir tous les demandes
    }

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
            $this->authorize('update', $this->openRequest);     //only admin
            $this->openRequest->update([
                'state'=>'adopted'
            ]);
            $this->dispatch('request-updated');     // pour que le compteur dans la sidebar s'actualise
            $this->closeModal();
        }
    }

    public function requestDeny():void
    {
        if ( $this->openRequest ){
            $this->authorize('update', $this->openRequest);     //only admin
            $this->openRequest->update([
                'state'=>'refused'
            ]);
            $this->dispatch('request-updated');     // pour que le compteur dans la sidebar s'actualise
            $this->closeModal();
        }
    }

    public function updateState($state)
    {
        if ( $this->openRequest ){  //quand c'est ouvert je peux changer state
            $this->authorize('update', $this->openRequest);     //only admin
            $this->openRequest->update([
                'state'=>$state,
            ]);
            $this->dispatch('request-updated');     // pour que le compteur dans la sidebar s'actualise
        }
    }


    public function openModal( int $request_id):void
    {
        $this->openRequest = Request::findOrFail($request_id );

        $this->authorize('view', $this->openRequest);   // ajouter car sinon policy ne marche pas
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

    public function destroy()
    {
        $this->authorize('delete', $this->openRequest);   // ajouter car sinon policy ne marche pas //seulement admin
        $this->openRequest->delete();
        return redirect(route('pages::adoption-requests.index', ['locale' => app()->getLocale()]));
    }
};
