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
        $this->volunteer = $volunteer;
        $this->availabilities = Availability::where('user_id', $volunteer->id)->first();
    }


    public function destroy(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $this->volunteer->delete();

        return redirect(route('pages::volunteers.index', ['locale' =>  __('general.currentLocale')]));
    }

    public function render()
    {
        return view('pages.volunteers.⚡show.show')->title(__('general.volunteers_detail'));
    }
};
