<?php

use App\Models\Message;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public string $term = '';
    public bool $isopenModal = false;
    public ?Message $openMessage = null;


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
                ->orderBy('created_at', 'asc')
                ->get();
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
