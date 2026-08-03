<?php

use App\Models\Message;
use \App\Models\Request;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{

    #[On('message-updated')]
    #[On('request-updated')]
    public function render()
    {
        $message_number = Message::where('state', '!=', 'read')->count();;

        $adoption_requests_number = Request::where('state', '=', 'not_treated_yet')->count();

        return view('components.sidebar.sidebar', [ 'message_number'=> $message_number, 'adoption_requests_number'=>$adoption_requests_number
        ]);
    }
};
