<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new  #[Layout('layouts.app')] class extends Component
{
    public $volunteers;
    public string $term = '';

    public function mount(): void
    {
        $this->volunteers = User::get();
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
                ->orderBy('created_at', 'asc')
                ->get();
    }




};
