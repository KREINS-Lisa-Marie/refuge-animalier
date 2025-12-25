<?php

use App\Models\Message;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    public $messages;

    public function mount(): void
    {
        $this->messages = Message::get();
    }
};
