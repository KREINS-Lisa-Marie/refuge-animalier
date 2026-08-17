<?php

use App\Models\Animal;
use App\Models\Message;
use App\Models\Request;
use App\Policies\DashboardPolicy;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component {

    public $animals;
    public $not_treated_adoptions;
    public $animals_in_shelter;
    public $unread_messages;
    public $animals_this_year;
    public $notifications;
    public $total_adopted_animals;
    public $five_latest_animals;
    public $user;
    public $message_number;
    public $taskAlert;
    public $volunteersInTeam;


    public $statistics_end_date;
    public $statistics_start_date;
    public $number_animals_welcomed = 0;
    public $finished_adoptions = 0;
    public $animals_still_in_shelter = 0;



//tri
    public $sortField = 'created_at';
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

    public function filteringStatistics()
    {
        $this->validate([
            'statistics_start_date'=>'required|date',
            'statistics_end_date'=>'required|date|after_or_equal:statistics_start_date',
        ]);

        $start = Carbon::parse($this->statistics_start_date)->startOfDay();
        $end = Carbon::parse($this->statistics_end_date)->endOfDay();

        $this->number_animals_welcomed = Animal::whereBetween('created_at', [$start, $end])->count();

        $this->animals_still_in_shelter = Animal::whereNot('state', 'adopted')->where('updated_at', '<=', $end)->count();

        $this->finished_adoptions = Animal::where('state', 'adopted')->whereBetween('updated_at', [$start, $end])->count();
    }

    public function exportStatsPdf()
    {
        $this->validate([
            'statistics_start_date'=>'required|date',
            'statistics_end_date'=>'required|date|after_or_equal:statistics_start_date',
        ]);

        $start = Carbon::parse($this->statistics_start_date)->startOfDay();
        $end = Carbon::parse($this->statistics_end_date)->endOfDay();

        $this->number_animals_welcomed = Animal::whereBetween('created_at', [$start, $end])->count();

        $this->animals_still_in_shelter = Animal::whereNot('state', 'adopted')->where('updated_at', '<=', $end)->count();

        $this->finished_adoptions = Animal::where('state', 'adopted')->whereBetween('updated_at', [$start, $end])->count();

        $pdf = PDF::loadView('pdf.shelter_statistics', [
            'start'=>$this->statistics_start_date,
            'end'=>$this->statistics_end_date,
            'number_animals_welcomed'=> $this->number_animals_welcomed,
            'finished_adoptions' => $this->finished_adoptions,
            'animals_still_in_shelter' => $this->animals_still_in_shelter,
        ])->setPaper('A4');

        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, 'report.pdf');       //nom du fichier

        // streamDownload = envoie fichier au navigateur sans écrire sur serveur
        //use($pdf) donne accès aux var de pdf
        //stream génère et retourne le contenu
        //echo affiche
    }

    public function index()
    {
        $not_treated_adoptions = Request::where('state', 'not_treated_yet')->get();
        return view('pages.dashboard.⚡index.index', compact('not_treated_adoptions'));
    }


    public function mount()         //mets initial data pour le component.
    {
        $this->authorize('view-dashboard');

        //$this->animals = Animal::get();
        //$this->not_treated_adoptions = Request::where('state', 'not_treated_yet')->count();
        $this->volunteersInTeam = \App\Models\User::where('is_admin', '0')->count();
        $this->animals_in_shelter = Animal::whereNot('state', 'adopted')->count();
        $this->unread_messages = Message::where('state', '!=', 'read')->count();
        $this->animals_this_year = Animal::whereYear('created_at', now()->year)->count();
        $this->notifications = $this->unread_messages;
        $this->total_adopted_animals = Animal::where('state', 'adopted')->count();
        $this->taskAlert = Request::where('state', 'not_treated_yet')->count();

        $this->five_latest_animals = Animal::latest()->limit(5)->get();
        $this->user = \Auth::user();

        $this->statistics_start_date = now()->startOfMonth()->format('Y-m-d');
        $this->statistics_end_date = now()->format('Y-m-d');
        $this->filteringStatistics();
    }

    public function render()
    {
        //$latest_animals = Animal::latest()->limit(5)->get(); //ici parce que ça doit rerender à chaque fois que je change de direction
        $this->five_latest_animals =
            $this->sortDirection === 'asc'
                ?$this->five_latest_animals->sortBy($this->sortField)
                : $this->five_latest_animals->sortByDesc($this->sortField);

        return view('pages.dashboard.⚡index.index', ['five_latest_animals'=> $this->five_latest_animals])->title(__('general.dashboard'));

    }

};


/*
 * https://carbon.nesbot.com/develop/reference.html#carbon-startofday
 * https://carbon.nesbot.com/develop/reference.html#carbon-endofday
 *https://github.com/barryvdh/laravel-dompdf
 * https://livewire.laravel.com/docs/4.x/downloads#streaming-downloads
 *https://laravel-livewire.com/docs/2.x/file-downloads#introduction
 *https://laravel.com/docs/13.x/responses#streamed-downloads
 * */
