<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.app')] class extends Component
{

    public $user;
    public $locale;

    public function mount(): void
    {
        $this->user = \Auth::user();
    }

    public function destroy(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $user= Auth::user();
        $user->delete();
        $this->locale=  __('general.currentLocale');

        return redirect(route("/$locale/login"));
    }

    public function render()
    {
        return view('pages.profile.⚡index.index')->title(__('general.profile'));
    }
};
