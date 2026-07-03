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

            $this->openMessage->update([
                'state'=>'read'
            ]);
            $this->closeModal();
        }
    }

    public function destroy():void
    {
        if ($this->openMessage) {
            $this->openMessage->delete();
            $this->closeModal();
        }
    }
};
