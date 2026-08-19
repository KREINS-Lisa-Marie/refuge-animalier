<?php

use App\Models\Message;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $term = '';
    public bool $isopenModal = false;
    public ?Message $openMessage = null;

    //tri
    public $sortField = 'first_name';
    public $sortDirection = 'asc';
    protected $queryString =['sortField', 'sortDirection'];


    public function mount(): void
    {
        $this->authorize('viewAny', Message::class);        //sinon ça doit à chaque sort vérifier authorization        //tous les users peuvent voir tous les messages
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


    // champs de recherche
    #[Computed]
    public function searchedMessages()
    {
        return
            Message::query()
                ->where('first_name', 'like', '%' . $this->term . '%')
                ->orWhere('last_name', 'like', '%' . $this->term . '%')
                ->orWhere('subject', 'like', '%' . $this->term . '%')
                ->orWhere('email', 'like', '%' . $this->term . '%')
                ->orWhere('created_at', 'like', '%' . $this->term . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
    }


    // ouvrir modale
    public function openModal( int $messageId):void
    {
        $this->openMessage = Message::findOrFail($messageId );

        $this->authorize('view', $this->openMessage);   // ajouter car sinon policy ne marche pas

        $this->isopenModal = true;
    }

    //fermer modale
    public function closeModal():void
    {
        $this->isopenModal = false;
        $this->openMessage = null;
    }

    //changement de state pour messages
    public function messageIsRead():void
    {
        if ( $this->openMessage ){

            $this->authorize('update', $this->openMessage);     //only admin
            $this->openMessage->update([
                'state'=>'read'
            ]);
            $this->dispatch('message-updated');     // pour que le compteur dans la sidebar s'actualise
            $this->closeModal();
        }
    }

    public function destroy():void
    {
        if ($this->openMessage) {
            $this->authorize('delete', $this->openMessage);   // ajouter car sinon policy ne marche pas //seulement admin

            $this->openMessage->delete();
            $this->dispatch('message-updated');     // pour que le compteur dans la sidebar s'actualise
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('pages.messages.⚡index.index')->title(__('general.messages'));
    }
};

// https://laravel.com/docs/13.x/authorization
