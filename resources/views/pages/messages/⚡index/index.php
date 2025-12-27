<?php

use App\Models\Message;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public $messages;
    public string $term = '';

    public function mount(): void
    {
        $this->messages = Message::get();
    }


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







};
