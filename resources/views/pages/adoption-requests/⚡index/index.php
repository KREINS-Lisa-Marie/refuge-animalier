<?php

use App\Models\Animal;
use \App\Models\Request;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public $requests;

    public string $term = '';

/*    public function mount(): void
    {
        $this->requests = \App\Models\Request::get();
    }*/


    #[Computed]
    public function searchedRequests()
    {
        return
             Request::query()
                ->where('first_name', 'like', '%' . $this->term . '%')
                ->orWhere('last_name', 'like', '%' . $this->term . '%')
                ->orWhere('animal_id', 'like', '%' . $this->term . '%')
                ->orWhere('state', 'like', '%' . $this->term . '%')
                ->orderBy('created_at', 'asc')
                ->with(['animal'])
                ->get();
    }
};
