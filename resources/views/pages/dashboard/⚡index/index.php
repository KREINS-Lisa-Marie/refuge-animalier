<?php

use App\Models\Animal;
use App\Models\Message;
use App\Models\Request;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component {

    public $animals;
    public $not_treated_adoptions;
    public $animals_in_shelter;
    public $messages;
    public $animals_this_year;
    public $notifications;
    public $total_adopted_animals;
    public $five_latest_animals;
    public $user;
    public $message_number;

    public function index()
    {
        $not_treated_adoptions = Request::where('state', 'not_treated_yet')->get();
        return view('pages.dashboard.⚡index.index', compact('not_treated_adoptions'));
    }


    public function mount()         //mets initial data pour le component.
    {
        $this->animals = Animal::get();
        $this->not_treated_adoptions = Request::where('state', 'not_treated_yet')->get();
        $this->animals_in_shelter = Animal::whereNot('state', 'adopted')->get();
        $this->messages = Message::where('state', '!=', 'read')->get();
        $this->animals_this_year = Animal::whereYear('created_at', now()->year)->count();
        $this->notifications = Message::whereNot('state', 'read')->get();
        $this->total_adopted_animals = Animal::where('state', 'adopted')->get();

        $this->five_latest_animals = Animal::latest()->limit(5)->get();
        $this->user = \Auth::user();
    }

};
