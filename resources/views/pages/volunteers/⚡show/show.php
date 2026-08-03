<?php

use App\Models\Availability;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{
    public ?string $monday;
    public ?string $tuesday;
    public ?string $wednesday;
    public ?string $thursday;
    public ?string $friday;
    public ?string $saturday;
    public ?string $sunday;

    public User $volunteer;
    public ?Availability $availabilities;

    public function mount(User $volunteer): void
    {
        $this->authorize('view', $volunteer);        //sinon ça doit à chaque sort vérifier authorization        //tous les users peuvent voir tous les users
        $this->volunteer = $volunteer;
        $this->availabilities = Availability::where('user_id', $volunteer->id)->first();
    }


    public function destroy(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $this->volunteer);   // ajouter car sinon policy ne marche pas //seulement admin
        $this->volunteer->delete();

        return redirect(route('pages::volunteers.index', ['locale' =>  __('general.currentLocale')]));
    }

    public function render(User $volunteer)
    {
        $availabilities = Availability::where('user_id', $volunteer->id)->first();
        return view('pages.volunteers.⚡show.show', compact('availabilities'))->title(__('general.volunteers_detail'));
    }
};
